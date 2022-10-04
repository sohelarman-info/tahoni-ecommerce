<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class color extends Model
{
    function Attribute(){
        return $this->hasMany(attribute::class, 'color_id');
    }
    function cart(){
        return $this->hasMany(Cart::class,'color_id');
    }
}
