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

    public function details(){
        return $this->hasOne(ProductDetials::class,'product_id');
    }

    public function images(){
        return $this->hasMany(ProductImage::class,'product_id');
    }

    public function colors(){
        return $this->belongsToMany(Color::class,'product_colors','product_id','color_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class,'carts','product_id','order_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function user_favorite()
    {
        return $this->belongsToMany(User::class,'whishlists','product_id','user_id');
    }
}
