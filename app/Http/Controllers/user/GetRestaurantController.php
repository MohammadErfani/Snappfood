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

    public function categoryFoods(Restaurant $restaurant,FoodCategory $foodCategory)
    {
        return RestaurantFoodResource::restaurantId($restaurant->id)::make($foodCategory);
    }

    public function showFood(Restaurant $restaurant,Food $food)
    {
        if ($food->restaurant->id === $restaurant->id) {
            return FoodResource::make($food);
            }
        return ['message'=>"this food doesn't belong to this restaurant"];
    }
}
