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
        return redirect()->route('restaurant.dashboard');
    }

    public function reject(Order $order)
    {
        Gate::forUser(Auth::guard('salesman')->user())->authorize('order-ability', $order);
        $order->update(['status' => Order::REJECTED]);
        return redirect()->route('restaurant.dashboard');
    }

    public function sending(Order $order)
    {
        Gate::forUser(Auth::guard('salesman')->user())->authorize('order-ability', $order);
        $order->update(['status' => Order::SENDING]);
        return redirect()->route('restaurant.dashboard');
    }

    public function delivered(Order $order)
    {
        Gate::forUser(Auth::guard('salesman')->user())->authorize('order-ability', $order);
        $order->update(['status' => Order::DELIVERED]);
        return redirect()->route('restaurant.dashboard');
    }
}
