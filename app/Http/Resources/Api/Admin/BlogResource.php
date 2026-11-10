<?php

namespace App\Http\Resources\Api\Admin;

use App\Models\Api\Admin\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
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
            'author' => $this->whenLoaded('author', function () {
                return $this->author ? new AuthorboxResource($this->author) : null;
            }),
            'category' => $this->whenLoaded('category' , function(){
                return [
                    'id'=>$this->category ? $this->category->id : null,
                    'title'=>$this->getColumnLang('title','category'),
                    'slug' => $this->getColumnLang('slug','category')
                ];
            }),
            'faqs' => $this->whenLoaded('faqs', function(){
                
                return $this->faqs->map(function($faq){
                    return [
                        'id' => $faq->id,
                        'topic' => $faq->topic,
                        'question' => $this->getColumnLang('question'),
                        'answer' => $this->getColumnLang('answer'),
                    ];
                });
            }),
            'related_blogs'=> $this->whenLoaded('relatedBlogs', function(){
                return $this->getColumnsLangWithArrayRelation(['title','slug'] , 'relatedBlogs', ['id','blog_image']);
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