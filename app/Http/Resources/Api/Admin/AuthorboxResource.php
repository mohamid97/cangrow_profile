<?php

namespace App\Http\Resources\Api\Admin;

use App\Http\Resources\JsonResource;
use App\Traits\HandlesImage;
use Illuminate\Http\Request;

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
        ];
    }
}
