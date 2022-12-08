<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\FoodResource;
use App\Http\Resources\RestaurantFoodResource;
use App\Http\Resources\RestaurantResource;
use App\Models\Admin\FoodCategory;
use App\Models\Restaurant\Food;
use App\Models\Restaurant\Restaurant;
use App\Traits\AddressTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class GetRestaurantController extends Controller
{
    use AddressTrait;

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        Gate::authorize('has-address');
        $uAddress = auth()->user()->addresses->where('is_current', true)->first();
        $restaurants = $this->getNearRestaurant($uAddress->latitude,$uAddress->longitude,10);
        return RestaurantResource::collection($restaurants);

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Restaurant\Restaurant $restaurant
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

    /**
     * @param Restaurant $restaurant
     * @return mixed
     */
    public function foods(Restaurant $restaurant)
    {
        return RestaurantFoodResource::restaurantId($restaurant->id)::collection($restaurant->foodCategories);
    }

    /**
     * @param Restaurant $restaurant
     * @param FoodCategory $foodCategory
     * @return mixed
     */
    public function categoryFoods(Restaurant $restaurant, FoodCategory $foodCategory)
    {
        return RestaurantFoodResource::restaurantId($restaurant->id)::make($foodCategory);
    }

    /**
     * @param Restaurant $restaurant
     * @param Food $food
     * @return FoodResource|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function showFood(Restaurant $restaurant, Food $food)
    {
        if ($food->restaurant->id === $restaurant->id) {
            return FoodResource::make($food);
        }
        return response(['msg' => "this food doesn't belong to this restaurant"]);
    }


}
