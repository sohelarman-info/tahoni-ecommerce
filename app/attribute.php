<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class attribute extends Model
{
    function get_product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
    function Color(){
        return $this->belongsTo(color::class, 'color_id');
    }
    function Size(){
        return $this->belongsTo(size::class, 'size_id');
    }
}


