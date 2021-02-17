<?php

namespace App\Http\Resources;

use App\Models\ProductSize;
use App\Models\Size;
use Illuminate\Http\Resources\Json\JsonResource;
use DB,Auth;
use App\Models\Color;
class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $lang = $request->header('lang');
        $color_code=null;
        $color=Color::find($this->pivot->color_id);
        $size_name=null;
        if(!is_null($color)){
            $color_code=new ColorResource($color);
        }
        $size=ProductSize::find($this->pivot->size_id);
        if(!is_null($size)){
            $size_name=new SizeResource($size);
        }
        return [
            'id' => $this->id,
            'name' => $lang == 'ar' ? $this->name_ar : $this->name_en,
            'desc' => $lang == 'ar' ? $this->desc_ar : $this->desc_en,
            'image' =>getImageUrl('Products',$this->icon),
            'price' => $this->is_offer == 1 ?$this->price_offer :$this->price,
            'color' => $color_code,
            'size'=>$size_name,
            'quantity'=>(int)$this->pivot->quantity,
        ];
    }
}
