<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
    function color(){
        return $this->belongsTo(color::class,'color_id');
    }
    function size(){
        return $this->belongsTo(size::class,'size_id');
    }
}
