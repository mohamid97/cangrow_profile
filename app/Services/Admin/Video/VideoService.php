<?php

namespace App\Services\Admin\Video;

use App\Models\Api\Admin\Video;
use App\Services\BaseModelService;
use App\Traits\StoreMultiLang;

class VideoService extends BaseModelService
{
    use StoreMultiLang;

    protected string $modelClass = Video::class;

    public function store()
    {
        $data = $this->data;
        $this->setData($this->getBasicColumn(['url', 'product_id']));
        $video = parent::store();

        $this->processTranslations($video, $data, ['title']);

        return $video;
    }

    public function update($id)
    {
        $data = $this->data;
        $this->setData($this->getBasicColumn(['url', 'product_id']));
        $video = parent::update($id);

        if (array_key_exists('title', $data)) {
            $this->processTranslations($video, $data, ['title']);
        }

        return $video;
    }
}
