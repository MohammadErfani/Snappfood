<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\CartResource;
use App\Models\Order;
use App\Models\Pivots\FoodOrder;
use App\Models\restaurant\Food;
use App\Models\restaurant\Restaurant;
use App\Notifications\CartNotification;
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
        $food = Food::find($request->food_id);
        if (!Redis::exists($user->id)) {
            Redis::hset($user->id, 'restaurant_id', $food->restaurant->id);
        }
        if (Redis::hexists($user->id, $food->id)) {
            return response(['msg' => "you already add this food if you want to change count of this food update it in your cart"]);
        }
        if (Redis::hget($user->id, 'restaurant_id') != $food->restaurant->id) {
            return response(['msg' => "you cant add this food. This food is from another restaurant"]);
        }
        Redis::hset($user->id, $food->id, $request->count);
        return "your food add to cart";

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
        var_dump(Redis::hgetall($user->id));
        return "your cart updated";
    }


    public function destroy()
    {
        $user = auth()->user();
        if (!Redis::exists($user->id)) {
            return response(['msg' => "you don't have active cart to Delete "]);
        }

        Redis::del($user->id);
        return "your cart Deleted";
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
        Redis::del($user->id, $food->id);
        return response(['msg' => "This food deleted from your cart"]);

    }
    public function pay()
    {
        $user = auth()->user();
        if (!Redis::exists($user->id)) {
            return response(['msg' => "you don't have active cart to Pay "]);
        }
        $cart = Redis::hgetall($user->id);
        $order = Order::create(['restaurant_id' => $cart['restaurant_id'],
            'user_id' => $user->id,
            'address_id'=>$user->addresses->where('is_current', 1)->first()->id,
            'status'=>Order::PAID
            ]);
        unset($cart['restaurant_id']);
        foreach ($cart as $food=>$count){
            $cart[$food]=['count'=>$count];
        }
        $order->foods()->sync($cart);
        Redis::del($user->id);
        $total = $order->calculateTotal();
        $order->update(['total_price' => $total]);
        $data = [
            'header' => "Your Cart Paid",
            'button' => "Follow up your Cart",
            'url' => "https://www.snappfood.ir",
            'body' => "Your Cart Price is: $total"
        ];
        auth()->user()->notify(new CartNotification($data));
        return response(['msg' => "Your cart paid successfully"]);

    }
}
