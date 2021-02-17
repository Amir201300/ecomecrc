<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetialsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'product_dimensions' => $this->product_dimensions,
            'manufacturer' => $this->manufacturer,
            'country_of_origin' => $this->country_of_origin,
            'item_weight' => $this->item_weight,
            'fabric' => $this->fabric,
            'style' => $this->style,
            'neck_style' => $this->neck_style,
            'pattern' => $this->pattern,
        ];
    }
}
