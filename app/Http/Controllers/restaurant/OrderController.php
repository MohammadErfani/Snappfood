<?php

namespace App\Http\Controllers\restaurant;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Notifications\CartNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    public function show(Order $order)
    {
        Gate::forUser(Auth::guard('salesman')->user())->authorize('order-ability', $order);
        return view('restaurant.order.showOrder',compact('order'));

    }

    public function archive()
    {
        $orders = Order::all()->where('status', Order::DELIVERED)
                                ->where('restaurant_id', Auth::guard('salesman')->user()->restaurant->id);
        return view('restaurant.order.archive',compact('orders'));
    }

    public function accept(Order $order)
    {
        Gate::forUser(Auth::guard('salesman')->user())->authorize('order-ability', $order);
        $order->update(['status' => Order::INPROGRESS]);
        $data = [
            'header'=>"Your Cart Accepted by {$order->restaurant->name}",
            'button'=>"Follow up your Cart",
            'url'=>"https://www.snappfood.ir",
            'body'=>"Your foods is now in progress and soon would be sending "
        ];
        $user = $order->user;
        $user->notify(new CartNotification($data));
        return redirect()->route('restaurant.dashboard');
    }

    public function reject(Order $order)
    {
        Gate::forUser(Auth::guard('salesman')->user())->authorize('order-ability', $order);
        $order->update(['status' => Order::REJECTED]);
        $data = [
            'header'=>"Your Cart denied by {$order->restaurant->name}",
            'button'=>"Make New Cart",
            'url'=>"https://www.snappfood.ir",
            'body'=>"Sorry about this. Your money will keep in your wallet. If you Want we can return your money in 2 hour "
        ];
        $user = $order->user;
        $user->notify(new CartNotification($data));
        return redirect()->route('restaurant.dashboard');
    }

    public function sending(Order $order)
    {
        Gate::forUser(Auth::guard('salesman')->user())->authorize('order-ability', $order);
        $order->update(['status' => Order::SENDING]);
        $data = [
            'header'=>"Your Food Is Ready. We send your food in any minute",
            'button'=>"See Your shipment information",
            'url'=>"https://www.snappfood.ir",
            'body'=>"We hope Your food delivered to You as hot as we sent"
        ];
        $user = $order->user;
        $user->notify(new CartNotification($data));
        return redirect()->route('restaurant.dashboard');
    }

    public function delivered(Order $order)
    {
        Gate::forUser(Auth::guard('salesman')->user())->authorize('order-ability', $order);
        $order->update(['status' => Order::DELIVERED]);
        $data = [
            'header'=>"Your Food Delivered",
            'button'=>"Share Your Opinion with us",
            'url'=>"https://www.snappfood.ir",
            'body'=>"Please Comment and score your food and restaurant. Your Comments help Other to get better food."
        ];
        $user = $order->user;
        $user->notify(new CartNotification($data));
        return redirect()->route('restaurant.dashboard');
    }
}
