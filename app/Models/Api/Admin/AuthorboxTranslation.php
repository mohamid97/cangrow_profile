<?php

namespace App\Models\Api\Admin;

use Illuminate\Database\Eloquent\Model;

class AuthorboxTranslation extends Model
{
    protected $fillable = ['authorbox_id', 'locale', 'author_name', 'specialty', 'bio'];
}
