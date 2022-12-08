<?php

namespace App\Traits;

use App\Models\Restaurant\Restaurant;

trait AddressTrait
{

    public function getNearRestaurant($latitude,$longitude,$radius = 10)
    {
        return Restaurant::selectRaw("restaurants.id,is_open,name ,latitude, longitude")
            ->join('addresses', function ($q) {
                $q->on('restaurants.id', '=', 'addressable_id');
                $q->where('addressable_type', 'App\Models\restaurant\Restaurant');
            })
            ->selectRaw("( 6371 * acos( cos( radians(?) ) *
                           cos( radians( latitude ) )
                           * cos( radians( longitude ) - radians(?)
                           ) + sin( radians(?) ) *
                           sin( radians( latitude ) ) )
                         ) AS distance", [$latitude, $longitude, $latitude])
            ->having("distance", "<", $radius)
            ->orderBy("distance",'asc')
            ->offset(0)
            ->limit(20)
            ->get();
    }
}
