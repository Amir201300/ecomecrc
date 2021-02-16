<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table ='categories';

    protected $fillable = [
        'name_ar', 'name_en', 'desc_ar','desc_en','icon' ,'status' , 'level' ,'cat_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent(){
        return $this->belongsTo(Category::class,'cat_id');
    }
}
