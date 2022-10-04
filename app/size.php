<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class size extends Model
{
    function Attribute(){
        return $this->hasMany(attribute::class, 'size_id');
    }
    function cart(){
        return $this->hasMany(Cart::class,'size_id');
    }
}
