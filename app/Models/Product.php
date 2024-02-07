<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'title', 'description', 'price', 'discountPercentage', 'rating', 'stock', 'brand', 'category_id', 'thumbnail','weight','unit'
    ];
    public function category(){
        return $this->belongsTo(Category::class);
    }
}