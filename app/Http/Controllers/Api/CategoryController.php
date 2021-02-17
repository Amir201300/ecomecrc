<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator,Auth,Artisan,Hash,File,Crypt;

class CategoryController extends Controller
{
    use \App\Traits\ApiResponseTrait;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function mainCategory(Request  $request){
        $cats=Category::where('level',1)->where('status',1)->get();
        return $this->apiResponseData(CategoryResource::collection($cats),'',200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function subCategory(Request  $request){
        $cats=Category::where('level',2)->where('cat_id',$request->cat_id)->where('status',1)->get();
        return $this->apiResponseData(CategoryResource::collection($cats),'',200);
    }

}
