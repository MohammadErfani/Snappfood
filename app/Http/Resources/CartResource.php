<?php

namespace App\Http\Resources;

use App\Models\Pivots\FoodOrder;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'restaurant'=>[
                'title'=>$this->restaurant->name,
                'image'=>$this->whenNotNull($this->restaurant->picture)
            ],
            'food'=>CartFoodResource::collection(FoodOrder::all()->where('order_id',$this->id))
        ];
    }
}
