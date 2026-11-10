<?php

namespace App\Models\Api\Admin;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authorbox extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    protected $table = 'authorboxes';
    protected $fillable = ['photo', 'profile_link'];
    public $translatedAttributes = ['author_name', 'specialty', 'bio'];
    public $translationForeignKey = 'authorbox_id';
    public $translationModel = AuthorboxTranslation::class;
}
