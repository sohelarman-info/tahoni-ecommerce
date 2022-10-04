<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class brands extends Model
{
    function get_product(){
        return $this->hasMany(Product::class, 'brand_id');
    }
}
