<?php

namespace App\Services\Admin\Redirect;

use App\Models\Api\Admin\Redirect;
use App\Services\BaseModelService;

class RedirectService extends BaseModelService
{
    protected string $modelClass = Redirect::class;
}
