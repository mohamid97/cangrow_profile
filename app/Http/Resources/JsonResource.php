<?php

namespace App\Http\Resources;

use App\Traits\HandlesImage;
use App\Traits\HandlesResourceTranslations;
use Illuminate\Http\Resources\Json\JsonResource as LaravelJsonResource;

class JsonResource extends LaravelJsonResource
{
    use HandlesImage;
    use HandlesResourceTranslations;
}
