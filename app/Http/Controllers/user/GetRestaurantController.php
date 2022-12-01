<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Resources\FoodResource;
use App\Http\Resources\RestaurantFoodResource;
use App\Http\Resources\RestaurantResource;
use App\Models\admin\FoodCategory;
use App\Models\restaurant\Food;
use App\Models\restaurant\Restaurant;
use Illuminate\Http\Request;

class GetRestaurantController extends Controller
{
    /**
     * Display a listing of the Restaurants.
     *
     * //     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return RestaurantResource::collection(Restaurant::all());

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\restaurant\Restaurant $restaurant
     * //     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        return RestaurantResource::setMode('single')::make($restaurant);
    }

    public function foods(Restaurant $restaurant)
    {
        return RestaurantFoodResource::restaurantId($restaurant->id)::collection($restaurant->foodCategories);
    }

    public function categoryFoods(Restaurant $restaurant, FoodCategory $foodCategory)
    {
        return RestaurantFoodResource::restaurantId($restaurant->id)::make($foodCategory);
    }

    public function showFood(Restaurant $restaurant, Food $food)
    {
        if ($food->restaurant->id === $restaurant->id) {
            return FoodResource::make($food);
        }
        return ['message' => "this food doesn't belong to this restaurant"];
    }

    public function near()
    {
        $radius = 1000;
        $uAddress = auth()->user()->addresses->where('is_current', true)->first();
        $restaurants = Restaurant::selectRaw("restaurants.id,is_open,name ,latitude, longitude")
            ->join('addresses', function ($q) {
                $q->on('restaurants.id', '=', 'addressable_id');
            $q->where('addressable_type', 'App\Models\restaurant\Restaurant');
})
            ->selectRaw("( 6371 * acos( cos( radians(?) ) *
                           cos( radians( latitude ) )
                           * cos( radians( longitude ) - radians(?)
                           ) + sin( radians(?) ) *
                           sin( radians( latitude ) ) )
                         ) AS distance", [$uAddress->latitude, $uAddress->longitude, $uAddress->latitude])
            ->having("distance", "<", $radius)
            ->orderBy("distance",'asc')
            ->offset(0)
            ->limit(20)
            ->get();
return RestaurantResource::collection($restaurants);
    }

}
