<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FoodResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->name,
            'type'=>implode(', ',$this->foodCategories->pluck('name')->toArray()), //pluck => get only the field you want from collection
            'price' => $this->price,
            'off' => $this->discount == null ? $this->whenNotNull($this->discount) : [
                'label' => $this->discount->title,
                'factor' => $this->discount->percentage
            ],
            'raw_material' => $this->whenNotNull($this->material),
            'image' => $this->whenNotNull($this->picture)
        ];
    }
}
