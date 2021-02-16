<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function product(){
        return $this->belongsToMany(Product::class,'product_colors','color_id','product_id');
    }
}
