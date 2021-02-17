<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use DB, Auth;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $user = auth('api')->user();
        $lang = Auth::check() ? get_user_lang() : $request->header('lang');
        $is_fav = false;
        if ($user) {
            $is_fav = $this->user_favorite->contains($user->id);
        }

        return [
            'id' => $this->id,
            'name' => $lang == 'ar' ? (string)$this->name_ar : (string)$this->name_en,
            'desc' => $lang == 'ar' ? (string)$this->desc_ar : (string)$this->desc_en,
            'cat' => $this->cat ? $lang == 'en' ? $this->cat->name_en : $this->cat->name_ar : null,
            'image' => getImageUrl('Products', $this->icon),
            'rate' => (int)$this->rate,
            'price_product' => number_format((float)$this->price, 2, '.', ''),
            'price_after_offer' => number_format((float)$this->price_offer, 2, '.', ''),
            'is_offer' => $this->is_offer ? (int)$this->is_offer : 0,
            'offer_value' => (int)$this->offer_value,
            'is_favorite' => $is_fav,
            'colors' => ColorResource::collection($this->colors),
            'sizes' => SizeResource::collection($this->sizes),
            'images' => ImagesResource::collection($this->images),
            'details' => new ProductDetialsResource($this->details),
        ];
    }
}
