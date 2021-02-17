<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\AddressResource;
use App\Http\Resources\CartResource;
use App\Http\Resources\UserResource;
use App\Models\Cart;
use App\Models\user_address;
use App\Reposatries\CartRepo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator, Auth, Artisan, Hash, File, DB;

class CartController extends Controller
{
    use \App\Traits\ApiResponseTrait;

    /**
     * @param Request $request
     * @param CartRepo $CartRepo
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function addToCart(Request $request, CartRepo $CartRepo)
    {
        $validate_product = $CartRepo->validate_product($request->product_id, $request->size_id,$request->color_id);
        if (isset($validate_product)) {
            return $validate_product;
        }
        $type = $CartRepo->add_to_cart($request->product_id, $request->quantity,$request->size_id,$request->color_id);
        if ($type == 1)
            $msg = get_user_lang() == 'en' ? 'product added successfully' : 'تم اضافة المنتج بنجاح';
        if ($type == 2)
            $msg = get_user_lang() == 'en' ? 'product updated successfully' : 'تم تعديل المنتج بنجاح';
        return $this->apiResponseMessage(1, $msg, 200);
    }

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function myCart()
    {
        $user = Auth::user();
        $data = [
            'products' => CartResource::collection($user->my_cart),
            'total_price' => cart_price(),
        ];
        return $this->apiResponseData($data, 'success', 200);
    }

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function deleteMyCart()
    {
        $user = Auth::user();
        Cart::where('user_id', $user->id)->where('is_order', 0)->delete();
        $msg = get_user_lang() == 'en' ? 'cart deleted successfully' : 'تم حذف عربة التسوق بنجاح';
        return $this->apiResponseMessage(1, $msg, 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function deleteFromCart(Request $request)
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->where('is_order', 0)->where('product_id', $request->product_id)->first();
        if (is_null($cart)) {
            $msg = get_user_lang() == 'en' ? 'product not found' : 'المنتج غير موجود';
            return $this->apiResponseMessage(0, $msg, 200);
        }
        $cart->delete();
        $msg = get_user_lang() == 'en' ? 'product deleted successfully' : 'تم حذف المنتج بنجاح';
        return $this->apiResponseMessage(1, $msg, 200);
    }

    /**
     * @param Request $request
     * @param CartRepo $orderRepo
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function updateCart(Request $request, CartRepo $orderRepo)
    {
        $user = Auth::user();
        foreach ($request->products as $row) {
            $size_id =isset($row['size_id']) ? $row['size_id'] :0;
            $color_id =isset($row['color_id']) ? $row['color_id'] :0;
            $validate_product = $orderRepo->validate_product($row['id'],$size_id,$color_id);
            if (isset($validate_product)) {
                return $validate_product;
            }
        }
        Cart::where('user_id', $user->id)->where('is_order', 0)->delete();
        foreach ($request->products as $row) {
            $size_id =isset($row['size_id']) ? $row['size_id'] :0;
            $color_id =isset($row['color_id']) ? $row['color_id'] :0;
            $orderRepo->add_to_cart($row['id'], $row['quantity'],$size_id,$color_id);
        }
        $msg = get_user_lang() == 'en' ? 'cart updated successfully' : 'تم تعديل عربة التسوق بنجاح';
        return $this->apiResponseMessage(1, $msg, 200);
    }
}
