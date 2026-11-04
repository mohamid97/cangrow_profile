<?php

namespace App\Models\Api\Admin;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    protected $fillable = ['url', 'product_id'];
    public $translatedAttributes = ['title'];
    public $translationForeignKey = 'video_id';
    public $translationModel = VideoTranslation::class;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
