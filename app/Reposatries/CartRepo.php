<?php

namespace App\Reposatries;

use App\Http\Resources\ProductResource;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\user_address;
use Illuminate\Http\Request;
use Validator,Auth,Artisan,Hash,File,Crypt;

class CartRepo  {
    use \App\Traits\ApiResponseTrait;

    public function add_to_cart($product_id,$quantity,$size_id,$color_id){
        $user=Auth::user();
        $cart=Cart::where('user_id',$user->id)->where('product_id',$product_id)->where('is_order',0)->first();
        $type=2;
        if(is_null($cart)){
            $cart=new Cart;
            $cart->product_id=$product_id;
            $cart->user_id=$user->id;
            $type=1;
        }
        $cart->quantity=$quantity ? $quantity : 1;
        $cart->size_id=$size_id;
        $cart->color_id=$color_id;
        $cart->is_order=0;
        $cart->save();
        return $type;
    }

    /**
     * @param $product_id
     * @param $size_id
     * @param $color_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function validate_product($product_id,$size_id,$color_id){
        $lang=get_user_lang();
        $product=Product::where('id',$product_id)->where('status',1)->first();
        if(is_null($product)){
            $msg=get_user_lang() == 'en' ? 'product number '.$product_id.' not found'
                : 'المنتج رقم '.$product_id.' غير موجود';
            return $this->apiResponseMessage(0,$msg,200);
        }
        $product_name=$lang =='en' ? $product->name_en : $product->name_ar;
        if($size_id !=0 ) {
            $size=ProductSize::where('id',$size_id)->where('product_id',$product_id)->first();
            if (is_null($size)) {
                $msg = $lang == 'en' ? 'size required for product  ' . $product_name . ' not found'
                    : 'الحجم المطلوب للمنتج  ' . $product_name . ' غير موجود';
                return $this->apiResponseMessage(0, $msg, 200);
            }
        }
        if($color_id ) {
            if (!$product->colors->contains($color_id)) {
                $msg = $lang == 'en' ? 'color required for product ' . $product_name . ' not found'
                    : 'اللون المطلوب للمنتج ' . $product_name . ' غير موجود';
                return $this->apiResponseMessage(0, $msg, 200);
            }
        }
    }

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function checkAddress(){
        $user=Auth::user();
        $address=user_address::where('user_id',$user->id)->where('is_default',1)->first();
        if(is_null($address)){
            $msg=get_user_lang() =='en' ? 'please add your default address' : 'من فضلك ادخل عنوانك الافتراضي';
            return $this->apiResponseMessage(0,$msg,200);
        }
    }

}
