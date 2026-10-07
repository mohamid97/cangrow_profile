<?php

namespace App\Models\Api\Admin;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    protected $fillable = ['product_id', 'image'];
    public $translatedAttributes = ['title'];
    public $translationForeignKey = 'application_id';
    public $translationModel = ApplicationTranslation::class;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
