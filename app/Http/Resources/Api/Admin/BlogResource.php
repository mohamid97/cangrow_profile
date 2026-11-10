<?php

namespace App\Http\Resources\Api\Admin;

use App\Models\Api\Admin\Category;
use Illuminate\Http\Request;
use App\Http\Resources\JsonResource;
use App\Traits\HandlesImage;

class BlogResource extends JsonResource
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
            'slug' =>$this->getColumnLang('slug'),
            'small_des' => $this->getColumnLang('small_des'),
            'des' => $this->getColumnLang('des'),
            'blog_image' => $this->getImageUrl($this->blog_image),
            'breadcrumb' => $this->getImageUrl($this->breadcrumb),
            'category_id' => $this->category_id,
            'author_box_id' => $this->author_box_id,
            'category' => $this->whenLoaded('category' , function(){
                    return [
                        'id'=>$this->category ? $this->category->id : null,
                        'title'=>$this->category ? $this->category->title : null,
                        'slug' => $this->slug  ? $this->category->slug : null
                    ];
            }),
            'author' => $this->whenLoaded('author', function () {
                return [
                    'id' => $this->author?->id,
                    'author_name' => $this->getColumnLang('author_name', 'author'),
                    'specialty' => $this->getColumnLang('specialty', 'author'),
                    'bio' => $this->getColumnLang('bio', 'author'),
                    'photo' => $this->getImageUrl($this->author?->photo),
                    'profile_link' => $this->author?->profile_link,
                ];
            }),
            'faqs' => $this->whenLoaded('faqs', fn () => $this->getColumnsLangWithArrayRelation(
                ['question', 'answer'],
                'faqs',
                ['icon', 'topic']
            )),
            'related_blogs' => $this->whenLoaded('relatedBlogs', fn () => $this->getColumnsLangWithArrayRelation(
                ['title', 'slug'],
                'relatedBlogs',
                ['blog_image']
            )),
            'meta_title' => $this->getColumnLang('meta_title'),
            'meta_des' => $this->getColumnLang('meta_des'),
            'alt_image' => $this->getColumnLang('alt_image'),
            'title_image' => $this->getColumnLang('title_image'),
            'title' => $this->getColumnLang('title'),
            'created_at' => $this->created_at->format('Y-m-d'),
            'updated_at' => $this->updated_at->format('Y-m-d'),
        ];
    }
}