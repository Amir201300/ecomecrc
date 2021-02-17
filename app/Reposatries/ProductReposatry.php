<?php

namespace App\Reposatries;

use App\Interfaces\ProductInterface;
use App\Models\Product;
use App\Models\Product_size;
use App\Models\Whishlist;
use Auth;

class ProductReposatry  {
    use \App\Traits\ApiResponseTrait;

    public function filter_product($request, $products)
    {
        if($request->type == 1){
            $products=$products->orderBy('rate','desc')->where('rate','>=',3);
        }
        if($request->type == 2){
            $products=$products->orderBy('id','desc')->where('is_offer',1);
        }
        if($request->type == 3){
            $products=$products->whereHas('orders')->withCount('orders')->orderBy('orders_count','desc');
        }
        if($request->type == 4){
            $products=$products->orderBy('id','desc');
        }
        return $products;
    }

    /**
     * @param $product_id
     * @return mixed|void
     * @throws \Exception
     */
    public function add_to_favorite($product_id){
        $user=Auth::user();
        $product=Product::find($product_id);
        if(is_null($product)){
            $msg=get_user_lang() =='en' ? 'product not found' : 'المنتج غير موجود';
            return $this->apiResponseMessage(0,$msg,200);
        }
        $favorite=Whishlist::where('user_id',$user->id)->where('product_id',$product_id)->first();
        $msg=get_user_lang() =='en' ? 'product deleted from your Whishlist' : 'تم حذف المنتج من المفضلات';
        if(is_null($favorite)){
            $favorite=new Whishlist();
            $favorite->user_id=$user->id;
            $favorite->product_id=$product_id;
            $favorite->save();
            $msg=get_user_lang() =='en' ? 'product added to your Whishlist' : 'تم اضافة المنتج في المفضلات';
        }else {
            $favorite->delete();
        }
        return $this->apiResponseMessage(1,$msg,200);
    }


}
