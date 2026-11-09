<?php

namespace App\Services\Admin\Application;

use App\Models\Api\Admin\Application;
use App\Services\BaseModelService;
use App\Traits\StoreMultiLang;

class ApplicationService extends BaseModelService
{
    use StoreMultiLang;

    protected string $modelClass = Application::class;

    public function store()
    {
        $this->uploadSingleImage(['image'], 'uploads/applications');
        $application = parent::store($this->getBasicColumn(['product_id', 'image']));
        $this->processTranslations($application, $this->data, ['title']);

        return $application;
    }

    public function update($id)
    {
        $this->uploadSingleImage(['image'], 'uploads/applications');
        $application = parent::update($id, $this->getBasicColumn(['product_id', 'image']));
        $this->processTranslations($application, $this->data, ['title']);

        return $application;
    }
}
