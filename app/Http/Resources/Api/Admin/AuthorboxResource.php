<?php

namespace App\Http\Resources\Api\Admin;

use App\Traits\HandlesImage;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorboxResource extends JsonResource
{
    use HandlesImage;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'photo' => $this->getImageUrl($this->photo),
            'profile_link' => $this->profile_link,
            'author_name' => $this->getColumnLang('author_name'),
            'specialty' => $this->getColumnLang('specialty'),
            'bio' => $this->getColumnLang('bio'),
            'created_at' => $this->created_at?->format('Y-m-d'),
            'updated_at' => $this->updated_at?->format('Y-m-d'),
        ];
    }
}
