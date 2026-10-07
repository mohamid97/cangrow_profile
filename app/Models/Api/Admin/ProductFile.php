<?php

namespace App\Models\Api\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFile extends Model
{
    use HasFactory;
    protected $fillable = ['product_id' , 'file' , 'order'];

    public function product(){
        return $this->belongsTo(Product::class , 'product_id');
    }
    
}
