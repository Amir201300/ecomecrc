<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function cat()
    {
        return $this->belongsTo('App\Models\Category','cat_id');
    }

    public function sizes(){
        return $this->hasMany(ProductSize::class,'product_id');
    }
}
