<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\Pivots\FoodOrder;
use App\Models\restaurant\Food;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use function PHPUnit\Framework\isEmpty;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param OrderRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        $order = auth()->user()->orders->where('status',Order::NOTPAID)->first();
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
        if(FoodOrder::where('order_id',$order->id)->where('food_id',$food->id)->exists()){
            return response(['msg'=>"you already add this food if you want to change count of this food update it in your cart"]);
        }
        if($food->restaurant_id !== $order->restaurant_id)
        {
            return response(['msg'=>"you cant add this food. This food is from another restaurant"]);
        }
        $order->foods()->save($food,['count'=>$request->count]);
        return $order;

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
