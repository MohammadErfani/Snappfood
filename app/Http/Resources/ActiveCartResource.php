<?php

namespace App\Http\Resources;

use App\Models\restaurant\Restaurant;
use Illuminate\Http\Resources\Json\JsonResource;

class ActiveCartResource extends JsonResource
{
    private static Restaurant $restaurant;

    public static function getRestaurant(Restaurant $restaurant)
    {
        self::$restaurant = $restaurant;
        return self::class;
    }


    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $off = $this->discount ? 1-$this->discount->percentage:1;
        return ['restaurant' =>self::$restaurant->name,
            'foods'=>[
                'id' => $this->id,
                'title' => $this->name,
                'count'=>$this->count,
                'price'=>$this->price*$off
            ]
        ];
    }
}
