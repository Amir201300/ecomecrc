<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Reposatries\HandleDataReposatry;
use App\Reposatries\ProductReposatry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator,Auth,Artisan,Hash,File,Crypt;

class ProductsController extends Controller
{
    use \App\Traits\ApiResponseTrait;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ProductsByCategory(Request  $request,HandleDataReposatry $dataReposatry){
        $products=Product::where('cat_id',$request->cat_id)->where('status',1);
        return $dataReposatry->getAllData($products,$request,new ProductResource(null));
    }

    /**
     * @param ProductReposatry $ProductReposatry
     * @return mixed|void
     * @throws \Exception
     */
    public function addTOWhishlist(ProductReposatry $ProductReposatry,Request  $request){
        return $ProductReposatry->add_to_favorite($request->product_id);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function myWhishlist(){
        $user=Auth::user();
        return $this->apiResponseData(ProductResource::collection($user->my_wishlist),'',200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function singleProduct(Request  $request){
        $product=Product::find($request->product_id);
        if(is_null($product)){
            return  $this->apiResponseMessage(0,'المنتج غير موجود',200);
        }
        return $this->apiResponseData(new ProductResource($product),'',200);
    }

}
