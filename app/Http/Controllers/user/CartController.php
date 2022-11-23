<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\CartResource;
use App\Models\Order;
use App\Models\Pivots\FoodOrder;
use App\Models\restaurant\Food;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceResponse;
use Illuminate\Http\Response;
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

    /**
     * Store a newly created resource in storage.
     *
     * @param OrderRequest $request
     * @return Response
     */
    public function store(OrderRequest $request)
    {
        $order = auth()->user()->orders->where('status',Order::NOTPAID)->first();   //if there was active cart don't create new one
        $food = Food::find($request->food_id);
        if(empty($order)) {
            $order = Order::create(
                [
                    'restaurant_id' => $food->restaurant_id,
                    'user_id' => auth()->user()->id,
                    'address_id' => auth()->user()->addresses->where('is_current', 1)->first()->id,
                    'status' => Order::NOTPAID
                ]);
        }
        if(FoodOrder::where('order_id',$order->id)->where('food_id',$food->id)->exists()){         //don't add same food to cart
            return response(['msg'=>"you already add this food if you want to change count of this food update it in your cart"]);
        }
        if($food->restaurant_id !== $order->restaurant_id)       // don't allow adding foods from another restaurant
        {
            return response(['msg'=>"you cant add this food. This food is from another restaurant"]);
        }
        $order->foods()->save($food,['count'=>$request->count]);
        return response(CartResource::make($order));

    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @return Response
     */
    public function show(Order $order)
    {
        if($order->user->id !== auth()->user()->id){
            return response(['msg'=>"This Cart doesn't belongs to you"]);
        }
        return response(CartResource::make($order));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param OrderRequest $request
     * @return Response
     */
    public function update(OrderRequest $request)
    {
        $order = auth()->user()->orders->where('status',Order::NOTPAID)->first();
        $food = Food::find($request->food_id)->first();
        if(empty($order)) {
            return response(['msg'=>"you don't have active cart. First add Cart then update it"]);
        }
        if (!FoodOrder::where('order_id', $order->id)->where('food_id', $food->id)->exists()) {         //don't add same food to cart
            return response(['msg' => "this food doesn't exist in your cart"]);
        }
        FoodOrder::where('order_id',$order->id)->where('food_id',$food->id)->update(['count'=>$request->count]);
        return response(CartResource::make($order));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return Response
     */
    public function destroy()
    {
        $order = auth()->user()->orders->where('status',Order::NOTPAID)->first();
        if(empty($order)) {
            return response(['msg'=>"you don't have active cart. First add Cart then update it"]);
        }
        $order->delete();
        return response(['msg'=>"Your active cart deleted "]);
    }

    public function deleteFood(Food $food)
    {
        $order = auth()->user()->orders->where('status',Order::NOTPAID)->first();
        if(empty($order)) {
            return response(['msg'=>"you don't have active cart. First add Cart then update it"]);
        }
        if (!FoodOrder::where('order_id', $order->id)->where('food_id', $food->id)->exists()) {         //don't add same food to cart
            return response(['msg' => "this food doesn't exist in your cart"]);
        }
        FoodOrder::where('order_id',$order->id)->where('food_id',$food->id)->delete();
        return response(['msg'=>"This food deleted from your cart"]);

    }

    public function pay(Order $order)
    {
        if($order->status === Order::NOTPAID){
            $order->update(['status'=>Order::PAID]);
        }else{
            return response(['msg'=>"This Cart already paid"]);
        }
        return response(['msg'=>"Your cart paid successfully"]);

    }
}
