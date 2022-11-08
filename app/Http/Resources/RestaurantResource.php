<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantResource extends JsonResource
{
    public static $mode = 'collection';
    public static function setMode(string $mode)
    {
            self::$mode = $mode;
        return self::class;
    }
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $restuarant= [
            'id' =>$this->id,
            'title'=>$this->name,
            'type'=>implode(', ',$this->restaurantCategories->pluck('name')->toArray()), //pluck => get only the field you want from collection
            'address'=>RestaurantAddressResource::make($this->address),
            'is_open'=>boolval($this->is_open),
            'image'=>$this->whenNotNull($this->picture),
            'score'=>$this->score
        ];
        if (self::$mode === 'single'){
            $restuarant['comments_count'] = $this->comments->count();
            $restuarant['schedule'] = RestaurantScheduleResource::collection($this->schedules);
        }
        return $restuarant;
    }
}
