<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class discout_code extends Model
{
    public function user_code(){
        return $this->belongsToMany(User::class,'user_discounts','code_id','user_id')
            ->withPivot('is_use');
    }
}
