<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\ActiveCartResource;
use App\Http\Resources\CartResource;
use App\Models\Order;
use App\Models\Pivots\FoodOrder;
use App\Models\restaurant\Food;
use App\Models\restaurant\Restaurant;
use App\Notifications\CartNotification;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redis;
use Illuminate\Validation\Rule;
use function PHPUnit\Framework\isEmpty;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return response(CartResource::collection(auth()->user()->orders));
    }


    public function store(OrderRequest $request)            // redis base cart
    {
        $user = auth()->user();
        \Illuminate\Support\Facades\Gate::forUser($user)->authorize('has-address');
        $food = Food::find($request->food_id);
        if (!Redis::exists($user->id)) {
            if ($food->restaurant->is_open) {
                Redis::hset($user->id, 'restaurant_id', $food->restaurant->id);
            } else {
                return response(['msg' => "This Restaurant is Closed"]);
            }

        }
        if (Redis::hexists($user->id, $food->id)) {
            return response(['msg' => "you already add this food if you want to change count of this food update it in your cart"]);
        }
        if (Redis::hget($user->id, 'restaurant_id') != $food->restaurant->id) {
            return response(['msg' => "you cant add this food. This food is from another restaurant"]);
        }
        Redis::hset($user->id, $food->id, $request->count);
        return response(['msg' => "This food added to Your Cart"]);

    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @return Response
     */
    public function show(Order $order)
    {
        if ($order->user->id !== auth()->user()->id) {
            return response(['msg' => "This Cart doesn't belongs to you"]);
        }
        return response(CartResource::make($order));
    }

    public function showActive()
    {
        $user = auth()->user();

        if (!Redis::exists($user->id)) {
            return response(['msg' => "you don't have active cart."]);
        }
        $cart = Redis::hgetall($user->id);
        $restaurant = Restaurant::find($cart['restaurant_id']);
        unset($cart['restaurant_id']);
        $foods = [];
        foreach ($cart as $id => $count) {
            $food = Food::find($id);
            $food->count = $count;
            $foods[] = $food;
        }
        return ActiveCartResource::getRestaurant($restaurant)::collection($foods);
    }


    public function update(OrderRequest $request)
    {
        $user = auth()->user();
        $food = Food::find($request->food_id);
        if (!Redis::exists($user->id)) {
            return response(['msg' => "you don't have active cart. First add Cart then update it"]);
        }
        if (!Redis::hexists($user->id, $food->id)) {
            return response(['msg' => "this food doesn't exist in your cart"]);
        }
        Redis::hset($user->id, $food->id, $request->count);
        return response(['msg' => "Your Cart Updated."]);
    }


    public function destroy()
    {
        $user = auth()->user();
        if (!Redis::exists($user->id)) {
            return response(['msg' => "you don't have active cart to Delete "]);
        }

        Redis::del($user->id);
        return response(['msg' => "Your Cart Deleted"]);
    }

    public function deleteFood(Food $food)
    {
        $user = auth()->user();
        if (!Redis::exists($user->id)) {
            return response(['msg' => "you don't have active cart. First add Cart then update it"]);
        }
        if (!Redis::hexists($user->id, $food->id)) {
            return response(['msg' => "this food doesn't exist in your cart"]);
        }
        Redis::hdel($user->id, $food->id);
        $cart = Redis::hgetall($user->id);
        unset($cart['restaurant_id']);
        if (empty($cart)) {
            Redis::del($user->id);
            return response(['msg' => "Your Cart deleted "]);
        }
        return response(['msg' => "This food deleted from your cart"]);

    }

    public function pay()
    {
        $user = auth()->user();
        if (!Redis::exists($user->id)) {
            return response(['msg' => "you don't have active cart to Pay "]);
        }
        $cart = Redis::hgetall($user->id);
        $restaurantId = $cart['restaurant_id'];
        unset($cart['restaurant_id']);
        $finalPrice = 0;
        foreach ($cart as $food => $count) {
            $cart[$food] = ['count' => $count];
            $finalPrice += Food::finalPrice($food, $count);
        }
        $money = $finalPrice - $user->wallet;
        if ($money > 0) {
            return response(['msg'=>"You don't have enough money in your wallet. You have $money short"]);
        }
        $user->wallet = -$money;
        $user->save();
        $order = Order::create(['restaurant_id' => $restaurantId,
            'user_id' => $user->id,
            'address_id' => $user->addresses->where('is_current', 1)->first()->id,
            'status' => Order::PAID
        ]);
        $order->foods()->sync($cart);
        $order->update(['status' => Order::ADDED, 'total_price' => $order->calculateTotal()]);
        Redis::del($user->id);
        return response(['msg' => "Your cart paid successfully"]);

    }
}
