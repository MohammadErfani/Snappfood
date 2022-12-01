<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Resources\FoodResource;
use App\Http\Resources\RestaurantFoodResource;
use App\Http\Resources\RestaurantResource;
use App\Models\admin\FoodCategory;
use App\Models\restaurant\Food;
use App\Models\restaurant\Restaurant;
use App\Traits\AddressTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class GetRestaurantController extends Controller
{
    use AddressTrait;

    public function index()
    {
        Gate::authorize('has-address');
        $uAddress = auth()->user()->addresses->where('is_current', true)->first();
        $restaurants = $this->getNearRestaurant($uAddress->latitude,$uAddress->longitude,50);
        return RestaurantResource::collection($restaurants);

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\restaurant\Restaurant $restaurant
     * //     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        //if You want to show only nearby restaurant uncomment below lines
//        Gate::authorize('has-address');
//        $uAddress = auth()->user()->addresses->where('is_current', true)->first();
//        $restaurants = $this->getNearRestaurant($uAddress->latitude,$uAddress->longitude,1);
//        if($restaurants->where('id',$restaurant->id)->count()===0)
//        {
//            return response(['msg'=>"This restaurant is far from you"]);
//        }
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


}
