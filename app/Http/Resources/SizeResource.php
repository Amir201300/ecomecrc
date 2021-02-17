<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use DB;
class SizeResource extends JsonResource
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
        return [
            'id' => $this->id,
            'name' =>  $this->name_ar ,
            'price_product' =>
                number_format((float)$this->price, 2, '.', '') ,
            'price_after_offer' =>
                number_format((float)$this->price_offer, 2, '.', '') ,
        ];
    }
}
