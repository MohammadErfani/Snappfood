<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryFoodResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->name,
            'price' => $this->price,
            'off' => $this->discount == null ? $this->whenNotNull($this->discount) : [
                'lable' => $this->discount->title,
                'factor' => $this->discount->percentage
            ],
            'raw_material' => $this->whenNotNull($this->material),
            'image' => $this->whenNotNull($this->picture)
        ];
    }
}
