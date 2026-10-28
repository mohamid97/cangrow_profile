<?php

namespace App\Http\Resources\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Resources\JsonResource;
use App\Models\Api\Admin\Lang;
use App\Traits\HandlesImage;
class CategoryResource extends JsonResource
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
            'slug' => $this->getColumnLang('slug'),
            'title' => $this->getColumnLang('title'),
            'small_des' => $this->getColumnLang('small_des'),
            'des' => $this->getColumnLang('des'),
            'meta_title' => $this->getColumnLang('meta_title'),
            'type' => $this->type,
            'parent' => $this->whenLoaded('parent', function () {
                return $this->getColumnsLangWithArrayRelation(['title' , 'slug' , 'id' ,'category_image'] , 'parent' );
            }),
            'childrens' => $this->whenLoaded('childrens', function () {
                  return $this->getColumnsLangWithArrayRelation(['title' , 'slug' , 'id' ,'category_image'] , 'childrens');
            }),
            'products' => $this->whenLoaded('products', function () {
                return $this->getColumnsLangWithArrayRelation(['title' , 'slug' , 'id' ,'product_image'] , 'products');
            }),
            'meta_des' => $this->getColumnLang('meta_des'),
            'category_image' => $this->getImageUrl($this->category_image),
            'breadcrumb' => $this->getImageUrl($this->breadcrumb),
            'title_image' => $this->getColumnLang('title_image'),
            'alt_image' => $this->getColumnLang('alt_image'),
            'thumbnail' => $this->getImageUrl($this->thumbnail),
            'order' => $this->order,
            'created_at' => $this->created_at->format('Y-m-d'),
            'updated_at' => $this->updated_at->format('Y-m-d'),
            'brands' => $this->whenLoaded('brands', function () {
               return $this->getColumnsLangWithArrayRelation(['title' , 'slug'] , 'brands' , ['image']);
            }),

           'blogs' => $this->whenLoaded('blogs', function () {
               return $this->getColumnsLangWithArrayRelation(['title' , 'slug'] , 'blogs' , ['blog_image']);
            }),
            'services' => $this->whenLoaded('services', function () {
               return $this->getColumnsLangWithArrayRelation(['title' , 'slug'] , 'services' , ['service_image']);
            }),

            'children' => $this->whenLoaded('nestedCategories', function () {
                return $this->getDeepCategories($this->nestedCategories);
            }),

        ];

    }

    protected function slugTranslation($category)
    {
        $translations = [];

        foreach (Lang::all() as $locale) {
            $translations[$locale->code] = $category->translate($locale->code)?->slug ?? null;
        }

        return $translations;
    }


    protected function getDeepCategories($categories)
    {
        return $categories->map(function ($category) {
            return [
                'id' => $category->id,
                'title' => $category->title,
                // need to return  with all langues 
                'slug' => $this->slugTranslation($category),
                'children' => $category->nestedCategories->isNotEmpty()
                    ? $this->getDeepCategories($category->nestedCategories)
                    : [],
                'category_image' => $this->getImageUrl($category->category_image),
            ];
        });
    }
    
}