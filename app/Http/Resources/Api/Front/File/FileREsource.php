<?php

namespace App\Http\Resources\Api\Front\File;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Traits\HandlesImage;

class FileREsource extends JsonResource
{
     use HandlesImage;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'file'=>$this->getImageUrl($this->file),
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
        ];
    }
}
