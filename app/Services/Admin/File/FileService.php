<?php
namespace App\Services\Admin\File;
use App\Traits\HandlesImage;

class FileService{

    use HandlesImage;

    protected $model;
    protected $fileModel;
    protected $foreignKeyField;
    protected $table;

    public function __construct($modelName)
    {
        $this->model = 'App\\Models\\Api\\Admin\\' . ucfirst($modelName);
        $this->fileModel = 'App\\Models\\Api\\Admin\\' . ucfirst($modelName) . 'File';
        $this->foreignKeyField = $modelName . '_id';
        $this->table = $modelName . '_files';
        
        $this->validateModels();
    }
    public static function  storeFile($data){
        $service = new self($data['model']);

        $service->validateParentModel($data);
        
        // Update order of existing images
        if (isset($data['old_order']) && !empty($data['old_order'])) {
            $service->updateFileOrder($data['old_order']);
        }
        
        $service->deleteRemovedFiles($data);
        
        if (isset($data['new_files']) && !empty($data['new_files'])) {
            $service->storeNewFiles($data['new_files'], $data[$service->foreignKeyField]);
        }
        return $service->getFileResults($data[$service->foreignKeyField]);
    }



    protected function validateModels()
    {
        if (!class_exists($this->fileModel)) {
            throw new \Exception("file model {$this->fileModel} does not exist");
        }
        
        if (!class_exists($this->model)) {
            throw new \Exception("Model {$this->model} does not exist");
        }
    }



    protected function validateParentModel($data)
    {
        if (!isset($data[$this->foreignKeyField])) {
            throw new \Exception("Foreign key field {$this->foreignKeyField} is required");
        }
        
        $model = $this->model;
        if (!$model::find($data[$this->foreignKeyField])) {
            throw new \Exception("Record with ID {$data[$this->foreignKeyField]} not found in {$this->model}");
        }
    }


    protected function updateFileOrder(array $orderData)
    {
        foreach ($orderData as $item) {
            $this->validateOrderItem($item);
            
            $gallery = $this->findFileItem($item['id']);
            $gallery->order = $item['order'];
            $gallery->save();
        }
    }


     protected function validateOrderItem($item)
    {
        if (!isset($item['id']) || !isset($item['order'])) {
            throw new \Exception("Order item must have 'id' and 'order' fields");
        }
    }




    protected function findFileItem($id)
    {
        $fileModel = $this->fileModel;
        $file = $fileModel::find($id);
        
        if (!$file) {
            throw new \Exception("File item with ID {$id} not found");
        }
        
        return $file;
    }



    protected function deleteRemovedFiles($data)
    {
        $fileModel = $this->fileModel;
        
        if (isset($data['old_order']) && !empty($data['old_order'])) {
            $existingIds = array_column($data['old_order'], 'id');
        
            foreach ($fileModel::where($this->foreignKeyField, $data[$this->foreignKeyField])->whereNotIn('id', $existingIds)->get() as $fileItem) {
                $this->deleteImage($fileItem->file);
                $fileItem->delete();
            }
        } else {

            foreach ($fileModel::where($this->foreignKeyField, $data[$this->foreignKeyField])->get() as $fileItem) {
                $this->deleteImage($fileItem->file);
                $fileItem->delete();
            }
        
        }

        
    }




    protected function storeNewFiles(array $newFiles, $foreignKeyValue)
    {
        foreach ($newFiles as $fileData) {
            $this->validateNewFileData($fileData);
            $this->createGalleryItem($fileData, $foreignKeyValue);
        }
    }

    public static function getFile($data){
        $service = new self($data['model']);
        $fileModel = $service->fileModel;

        $results = $fileModel::where($service->foreignKeyField, $data[$service->foreignKeyField])
            ->orderBy('order', 'asc')
            ->get();
        foreach ($results as $result) {
            $result->file = $service->getImageUrl($result->file);     
        }   
        return [
            'success' => true,
            'message' => 'Gallery retrieved successfully',
            'data' => $results
        ];
        
        
    }


    protected function getFileResults($foreignKeyValue)
    {
        $fileModel = $this->fileModel;
        
        $results = $fileModel::where($this->foreignKeyField, $foreignKeyValue)
            ->orderBy('order', 'asc')
            ->get();

        foreach ($results as $result) {
            $result->file = $this->getImageUrl($result->file);
        }

        return [
            'success' => true,
            'message' => 'Gallery updated successfully',
            'data' => $results
        ];
    }


    protected function validateNewFileData($fileData)
    {
        if (!isset($fileData['file']) || !isset($fileData['order'])) {
            throw new \Exception("New File must have 'file' and 'order' fields");
        }
    }

    protected function createGalleryItem(array $fileData, $foreignKeyValue)
    {
        $galleryModel = $this->fileModel;
        $file = new $galleryModel();
        
        $file->{$this->foreignKeyField} = $foreignKeyValue;
        $file->file = $this->uploadImages($fileData['file'], 'uploads/' . $this->table);
        $file->order = $fileData['order'];
        
        if (!$file->save()) {
            throw new \Exception("Failed to save file item");
        }
        
        return $file;
    }



    public function uploadImages($image, $upload = "uploads")
    {
        return $this->uploadImage($image, $upload);
    }


}