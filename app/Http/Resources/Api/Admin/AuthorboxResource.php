<?php

namespace App\Http\Resources\Api\Admin;

use App\Http\Resources\JsonResource;
use App\Traits\HandlesImage;
use Illuminate\Http\Request;

class AuthorboxResource extends JsonResource
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
            'id' => $this->id,
            'author_name' => $this->getColumnLang('author_name'),
            'photo' => $this->getImageUrl($this->photo),
            'specialty' => $this->getColumnLang('specialty'),
            'bio' => $this->getColumnLang('bio'),
            'profile_link' => $this->profile_link,
            'created_at' => $this->created_at?->format('Y-m-d'),
            'updated_at' => $this->updated_at?->format('Y-m-d'),
        ];
    }
}
