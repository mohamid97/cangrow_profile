<?php

namespace App\Http\Resources\Api\Admin;

use App\Traits\HandlesImage;
use Illuminate\Http\Request;
use App\Http\Resources\JsonResource;

class CertificateResource extends JsonResource
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
            'image'=>$this->getImageUrl($this->image),
            'date'=>$this->date,
            'title'=>$this->getColumnLang('title'),
            'des'=>$this->getColumnLang('des')
        ];

    }



}