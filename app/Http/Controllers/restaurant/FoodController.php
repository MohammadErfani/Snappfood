<?php

namespace App\Http\Controllers\restaurant;

use Facades\App\Caching\Discounts;
use Facades\App\Caching\FoodCategories;
use App\Http\Controllers\Controller;
use App\Http\Requests\FoodRequest;
use App\Models\admin\Discount;
use App\Models\admin\FoodCategory;
use App\Models\restaurant\Food;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('restaurant.food.food', ['foods' => Food::all()->where('restaurant_id',Auth::guard('salesman')->user()->restaurant->id)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('restaurant.food.createFood', ['foodCategories' => FoodCategories::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param FoodRequest $request
     * @return RedirectResponse
     */
    public function store(FoodRequest $request)
    {
        if ($request->file('picture') === null) {
            $picturePath = null;
        } else {
            $picturePath = $request->file('picture')->store('uploads/foods');
        }
        $food = Food::create([
            'name' => $request->name,
            'price' => $request->price,
            'material' => $request->material,
            'picture' => $picturePath,
            'restaurant_id' => Auth::guard('salesman')->user()->restaurant->id
        ]);
        $a = $request->input('foodCategory');
        $food->foodCategories()->attach($a);
        foreach ($food->foodCategories as $category) {
            if (isset($category->parent->id) && !in_array($category->parent->id, $request->foodCategory) && !in_array($category->parent->id, $a)) {
                $food->foodCategories()->attach($category->parent->id);
                $a[] = $category->parent->id;
            }
        }
        return redirect()->route('restaurant.food.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\restaurant\Food  $food
     * @return Food
     */
    public function show(Food $food)
    {
        return $food;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\restaurant\Food  $food
     * @return View
     */
    public function edit(Food $food)
    {
        $foodCategories = FoodCategories::all();
        $discounts = Discounts::all();
        return view('restaurant.food.editFood', compact('food', 'foodCategories', 'discounts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  FoodRequest  $request
     * @param  \App\Models\restaurant\Food  $food
     * @return RedirectResponse
     */
    public function update(FoodRequest $request, Food $food)
    {
        if ($request->file('picture') !== null) {
            $picturePath = $request->file('picture')->store('uploads/foods');
            $food->update(['picture' => $picturePath]);
        }

        $food->update([
            'name' => $request->name,
            'price' => $request->price,
            'material' => $request->material,
            'discount_id' => $request->discount
        ]);
        $categories = $request->foodCategory;
        $food->foodCategories()->sync($categories);
        return redirect()->route('restaurant.food.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\restaurant\Food  $food
     * @return RedirectResponse
     */
    public function destroy(Food $food)
    {
        $food->delete();
        return redirect()->route('restaurant.food.index');

    }
}
