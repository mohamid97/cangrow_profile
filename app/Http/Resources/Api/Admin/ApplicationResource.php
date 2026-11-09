<?php

namespace App\Http\Resources\Api\Admin;

use App\Traits\HandlesImage;
use Illuminate\Http\Request;
use App\Http\Resources\JsonResource;

class ApplicationResource extends JsonResource
{
    use HandlesImage;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'image' => $this->getImageUrl($this->image),
            'title' => $this->getColumnLang('title'),
        ];
    }
}
