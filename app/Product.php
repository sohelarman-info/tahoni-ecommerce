<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    function get_brand(){
        return $this->belongsTo(brands::class, 'brand_id');
    }
    function get_attribute(){
        return $this->hasMany(attribute::class, 'product_id');
    }
    function gallery(){
        return $this->hasMany(Gallery::class, 'product_id');
    }
    function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
    function subcategory(){
        return $this->belongsTo(SubCategory::class, 'subcategory_id');
    }
    function cart(){
        return $this->hasMany(Cart::class,'product_id');
    }
}

