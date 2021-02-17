<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use DB;
class ColorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $co=$this->colorCode;
        $color= trim($co,"#");
        return [
            'id' => $this->id,
            'color_code' => $color,
        ];
    }
}
