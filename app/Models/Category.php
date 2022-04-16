<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = [
        'name',
        'category_id',
        'product_id'
    ];

    public function products(){
        return $this->belongsToMany('App\Models\Product', 'product_category', 'category_id', 'product_id');
    }
}
