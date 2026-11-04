<?php

namespace App\Http\Resources\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Resources\JsonResource;

class VideoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'url' => $this->url,
            'title' => $this->getColumnLang('title'),
            'product_id' => $this->product_id,
            'created_at' => $this->created_at?->format('Y-m-d'),
            'updated_at' => $this->updated_at?->format('Y-m-d'),
        ];
    }
}
