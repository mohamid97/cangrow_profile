<?php

namespace App\Http\Resources\Api\Admin;

use App\Traits\HandlesImage;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FaqResource extends JsonResource
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
            'icon'=>$this->getImageUrl($this->icon),
            'topic'=>$this->topic,
            'question'=>$this->getColumnLang('question'),
            'answer'=>$this->getColumnLang('answer'),
            'blogs'=>$this->whenLoaded('blogs', function () {
                return $this->blogs->map(function ($blog) {
                    return [
                        'id' => $blog->id,
                        'title' => $blog->getColumnLang('title'),
                        'slug' => $blog->getColumnLang('slug'),
                    ];
                });
            }),

        ];
    }
}