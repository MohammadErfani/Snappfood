<?php

namespace App\Http\Controllers\restaurant;

use Facades\App\Caching\RestaurantCategories;
use App\Http\Controllers\Controller;
use App\Http\Requests\RestaurantRequest;
use App\Models\Address;
use App\Models\admin\RestaurantCategory;
use App\Models\Order;
use App\Models\restaurant\Restaurant;
use App\Models\restaurant\Schedule;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $orders = Order::all()->whereNotIn('status',[Order::PAID,Order::DELIVERED,Order::REJECTED])->where('restaurant_id',Auth::guard('salesman')->user()->restaurant->id);
        return view('restaurant.dashboard',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        Gate::forUser(Auth::guard('salesman')->user())->authorize('create-restaurant');
        return view('restaurant.createRestaurant', ['restaurantCategories' => RestaurantCategories::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \app\Http\Requests\RestaurantRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RestaurantRequest $request)
    {
        Gate::forUser(Auth::guard('salesman')->user())->authorize('create-restaurant');
        if ($request->file('picture') === null) {
            $picturePath = null;
        } else {
            $picturePath = $request->file('picture')->store('uploads/restaurants');
        }
        $restaurant = Restaurant::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'bank_account' => $request->bankAccount,
            'picture' => $picturePath,
            'salesman_id' => Auth::guard('salesman')->id()
        ]);
        $address = new Address(['address' => $request->address, 'latitude' => $request->lat, 'longitude' => $request->lng]);
        $restaurant->address()->save($address);
        $a = $request->input('restaurantCategory');
        $restaurant->restaurantCategories()->attach($a);
        foreach ($restaurant->restaurantCategories as $category) {
            if (isset($category->parent->id) && !in_array($category->parent->id, $a)) {
                $restaurant->restaurantCategories()->attach($category->parent->id);
                $a[] = $category->parent->id;
            }
        }
        return redirect()->route('restaurant.dashboard');
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return Auth::guard('salesman')->user()->restaurant;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     */
    public function edit()
    {

        $restaurant = Auth::guard('salesman')->user()->restaurant;
        $restaurantCategories = RestaurantCategories::all();
        $weekday = Schedule::WEEKDAY;
        return view('restaurant.editRestaurant', compact('restaurant', 'restaurantCategories', 'weekday'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \app\Http\Requests\RestaurantRequest $request
     * @return RedirectResponse
     */
    public function update(RestaurantRequest $request)
    {
        $restaurant = Auth::guard('salesman')->user()->restaurant;

        if ($request->file('picture') !== null) {
            $picturePath = $request->file('picture')->store('uploads/restaurants');
            $restaurant->update(['picture' => $picturePath]);
        }
        $restaurant->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'bank_account' => $request->bankAccount,
        ]);
        $restaurant->address()->update(['address' => $request->address, 'latitude' => $request->lat, 'longitude' => $request->lng]);
        $categories = $request->restaurantCategory;
        $restaurant->restaurantCategories()->sync($categories);
        $check = $restaurant->schedules->isEmpty();
        if ($request->checkbox != null) {
            $check ? $restaurant->saveSchedules($request->time): $restaurant->updateSchedules($request->time);
        } else {
            $time = [$request->open, $request->close];
            $check ? $restaurant->saveSchedules($time, false): $restaurant->updateSchedules($time,false);
        }
        return redirect()->route('restaurant.dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        Auth::guard('salesman')->user()->restaurant->delete();
        return redirect()->route('restaurant.create');
    }

    public function changeStatus(Request $request)
    {
        Auth::guard('salesman')->user()->restaurant->update(['is_open'=>$request->status=='0'?false:true]);
        return redirect()->route('restaurant.edit');
    }

}
