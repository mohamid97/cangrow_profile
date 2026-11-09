<?php

namespace App\Services\Admin\Authorbox;

use App\Models\Api\Admin\Authorbox;
use App\Services\BaseModelService;
use App\Traits\HandlesImage;
use App\Traits\StoreMultiLang;

class AuthorboxService extends BaseModelService
{
    use HandlesImage, StoreMultiLang;

    protected string $modelClass = Authorbox::class;

    public function store()
    {
        $this->uploadSingleImage(['photo'], 'uploads/authorboxes');
        $authorbox = parent::store();
        $this->processTranslations($authorbox, $this->data, ['author_name', 'specialty', 'bio']);

        return $authorbox;
    }

    public function update($id)
    {
        $this->uploadSingleImage(['photo'], 'uploads/authorboxes');
        $authorbox = parent::update($id);
        $this->processTranslations($authorbox, $this->data, ['author_name', 'specialty', 'bio']);

        return $authorbox;
    }
}
