<?php

namespace App\Services\Admin\Application;

use App\Models\Api\Admin\Application;
use App\Services\BaseModelService;
use App\Traits\HandlesImage;
use App\Traits\StoreMultiLang;
use Illuminate\Database\Eloquent\Builder;

class ApplicationService extends BaseModelService
{
    use HandlesImage, StoreMultiLang;

    protected string $modelClass = Application::class;
    protected array $relations = ['product'];

    public function all($request)
    {
        $query = $this->modelClass::with($this->relations);

        if (!empty($request['product_id'])) {
            $query->where('product_id', $request['product_id']);
        }

        if (!empty($request['search'])) {
            $query = $this->applySearch($query, $request['search']);
        }

        if (!empty($request['orderBy'])) {
            $query = $query->orderBy(
                $request['orderBy'],
                $request['orderDirection'] ?? 'DESC'
            );
        }

        return isset($request['paginate'])
            ? $query->paginate($request['paginate'])
            : $query->get();
    }

    public function store()
    {
        $this->uploadSingleImage(['image'], 'uploads/products/applications');
        $translationData = $this->data;
        $this->data = $this->getBasicColumn(['product_id', 'image']);
        $application = parent::store();
        $this->processTranslations($application, $translationData, ['title']);

        return $application->load($this->relations);
    }

    public function update($id)
    {
        $this->uploadSingleImage(['image'], 'uploads/products/applications');
        $translationData = $this->data;
        $this->data = $this->getBasicColumn(['product_id', 'image']);
        $application = parent::update($id);
        $this->processTranslations($application, $translationData, ['title']);

        return $application->load($this->relations);
    }

    public function applySearch(Builder $query, string $search)
    {
        return $query->whereTranslationLike('title', "%{$search}%");
    }
}
