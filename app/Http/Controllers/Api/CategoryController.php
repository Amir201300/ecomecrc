<?php

namespace App\Http\Controllers\Api;

use App\Interfaces\UserInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator,Auth,Artisan,Hash,File,Crypt;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Http\Controllers\Manage\EmailsController;

class CategoryController extends Controller
{
    use \App\Traits\ApiResponseTrait;

    public function mainCategory(Request  $request){

    }

}
