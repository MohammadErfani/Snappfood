<?php

namespace App\Http\Resources;

use App\Models\Admin\FoodCategory;
use App\Models\Restaurant\Restaurant;
use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantFoodResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = 'categories';
    public static $restaurntId =0;
    public static function restaurantId(int $id)
    {
        self::$restaurntId = $id;
        return self::class;
    }
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'title'=>$this->name,
            'foods'=>CategoryFoodResource::collection(FoodCategory::find($this->id)->foods->where('restaurant_id',self::$restaurntId))

        ];
    }
}
