<?php

namespace App\Http\Resources;

use App\Models\Restaurant\Schedule;
use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantScheduleResource extends JsonResource
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
            array_search($this->weekday,Schedule::WEEKDAY)=>[
                'start'=>$this->open_hour,
                'end'=>$this->close_hour
            ]
        ];
    }
}
