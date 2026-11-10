<?php

namespace App\Services\Admin\Authorbox;

use App\Models\Api\Admin\Authorbox;
use App\Services\BaseModelService;
use App\Traits\HandlesImage;
use App\Traits\StoreMultiLang;

class AuthorboxService extends BaseModelService
{
    use StoreMultiLang, HandlesImage;

    protected string $modelClass = Authorbox::class;

    public function store()
    {
        $this->uploadSingleImage(['photo'], 'uploads/authorboxes');
        $authorbox = parent::store($this->getBasicColumn(['photo', 'profile_link']));
        $this->processTranslations($authorbox, $this->data, ['author_name', 'specialty', 'bio']);

        return $authorbox;
    }

    public function update($id)
    {
        $this->uploadSingleImage(['photo'], 'uploads/authorboxes');
        $authorbox = parent::update($id, $this->getBasicColumn(['photo', 'profile_link']));
        $this->processTranslations($authorbox, $this->data, ['author_name', 'specialty', 'bio']);

        return $authorbox;
    }
}
