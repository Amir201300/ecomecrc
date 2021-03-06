<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Controllers\Manage\BaseController;


class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $lang=$request->header('lang');
        return [
            'id' => $this->id,
            'name' =>$lang =='en' ? $this->name_en : $this->name_ar,
            'desc' =>$lang =='en' ? $this->desc_en : $this->desc_ar,
            'image' => getImageUrl('Category',$this->image),
        ];
    }
}
