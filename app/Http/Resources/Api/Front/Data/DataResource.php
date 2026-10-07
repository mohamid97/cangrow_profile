<?php

namespace App\Http\Resources\Api\Front\Data;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id' => $this->id,
            'title' => $this->getColumnLang('title'),
            'slug' => $this->getColumnLang('slug'),
            
        ];
    }
}
