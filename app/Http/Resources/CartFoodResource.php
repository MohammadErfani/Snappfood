<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartFoodResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $off = $this->food->discount ? 1-$this->food->discount->percentage:1;
        return [
            'id' => $this->food->id,
            'title' => $this->food->name,
            'count'=>$this->count,
            'price'=>$this->food->price*$off
        ];
    }
}
