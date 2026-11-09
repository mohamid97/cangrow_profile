<?php

namespace App\Models\Api\Admin;

use Illuminate\Database\Eloquent\Model;

class AuthorboxTranslation extends Model
{
    protected $table = 'authorbox_translations';

    protected $fillable = ['author_name', 'specialty', 'bio'];
}
