<?php

namespace App\Http\Resources\Api\Admin;

use App\Traits\HandlesImage;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationResource extends JsonResource
{
    use HandlesImage;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'title' => $this->getColumnLang('title'),
            'image' => $this->getImageUrl($this->image),
            'product' => $this->whenLoaded('product', function () {
                return [
                    'id' => $this->product->id,
                    'title' => $this->getColumnLang('title', 'product'),
                ];
            }),
            'created_at' => $this->created_at?->format('Y-m-d'),
            'updated_at' => $this->updated_at?->format('Y-m-d'),
        ];
    }
}
