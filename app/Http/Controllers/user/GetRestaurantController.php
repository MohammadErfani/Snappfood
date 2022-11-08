<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Resources\RestaurantFoodResource;
use App\Http\Resources\RestaurantResource;
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
}
