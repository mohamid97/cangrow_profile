<?php

namespace App\Http\Resources\Api\Admin;

use App\Traits\HandlesImage;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'title' => $this->getColumnLang('title'),
            'slug' => $this->getColumnLang('slug'),
            'price' => $this->price,
            'category_id' => $this->category_id,
            'category' => $this->whenLoaded('category' , function(){
                    return [
                        'id'=>$this->category ? $this->category->id : null,
                        'title'=>$this->getColumnLang('title','category'),
                        'slug' => $this->getColumnLang('slug','category')
                    ];
            }),

            'brand' => $this->whenLoaded('brand' , function(){
                    return [
                        'id'=>$this->brand ? $this->brand->id : null,
                        'title'=>$this->getColumnLang('title','brand'),
                        'slug'=>$this->getColumnLang('slug','brand'),
                    ];
            }),
            'applications' => $this->whenLoaded('applications', function () {
                return $this->applications->map(function ($application) {
                    return [
                        'id' => $application->id,
                        'title' => $application->title,
                        'image' => $this->getImageUrl($application->image),
                    ];
                });
            }),
            'gallery' => $this->whenLoaded('gallery', function () {
                return $this->gallery->map(function ($galleryItem) {
                    return [
                        'id' => $galleryItem->id,
                        'image' => $this->getImageUrl($galleryItem->image),
                    ];
                });
            }),
        
            'order' => $this->order,
            'small_des' => $this->getColumnLang('small_des'),
            'des' => $this->getColumnLang('des'),
            'image' => $this->getImageUrl($this->product_image),
            'breadcrumb' => $this->getImageUrl($this->breadcrumb),
            'title_image' => $this->getColumnLang('title_image'),
            'alt_image' => $this->getColumnLang('alt_image'),
            'meta_title' => $this->getColumnLang('meta_title'),
            'meta_des' => $this->getColumnLang('meta_des'),
            // 'order'=>$this->order,
            'barcode'=>$this->barcode,
            'status'=>$this->status,
            'created_at' => $this->created_at?->format('Y-m-d'),
            'updated_at' => $this->updated_at?->format('Y-m-d'),
        
        ];

    

        

        
    }


    

    
}