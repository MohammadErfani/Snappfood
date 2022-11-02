<?php

namespace App\Http\Controllers\restaurant;

use App\Http\Controllers\Controller;
use App\Http\Requests\RestaurantRequest;
use App\Models\admin\RestaurantCategory;
use App\Models\restaurant\Restaurant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('restaurant.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('restaurant.createRestaurant', ['restaurantCategories' => RestaurantCategory::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \app\Http\Requests\RestaurantRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RestaurantRequest $request)
    {
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
        $restaurant->restaurantCategories()->attach($request->input('restaurantCategory'));
        return redirect()->route('restaurant.dashboard');
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     */
    public function edit()
    {

        $restaurant = Auth::guard('salesman')->user()->restaurant;
        $restaurantCategories = RestaurantCategory::all();
        return view('restaurant.editRestaurant', compact('restaurant', 'restaurantCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
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
        $categories = $request->restaurantCategory;
        foreach ($restaurant->restaurantCategories as $category) {
            if (in_array($category->id, $categories)) {
                array_splice($categories, array_search($category->id,$categories), 1);
            } else {
                $restaurant->restaurantCategories()->detach($category->id);
            }
        }

        if (!empty($categories)){
            $restaurant->restaurantCategories()->attach($categories);
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
}
