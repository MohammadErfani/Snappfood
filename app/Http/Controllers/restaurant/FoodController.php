<?php

namespace App\Http\Controllers\restaurant;

use App\Http\Controllers\Controller;
use App\Http\Requests\FoodRequest;
use App\Models\admin\Discount;
use App\Models\admin\FoodCategory;
use App\Models\restaurant\Food;
use Illuminate\Http\RedirectResponse;
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
        return view('restaurant.food.food', ['foods' => Food::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('restaurant.food.createFood', ['foodCategories' => FoodCategory::all()]);
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
     * @return View
     */
    public function edit($id)
    {
        $food = Food::find($id)->first();
        $foodCategories = FoodCategory::all();
        $discounts = Discount::all();
        return view('restaurant.food.editFood', compact('food', 'foodCategories', 'discounts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FoodRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(FoodRequest $request, $id)
    {
        $food = Food::find($id)->first();
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
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        Food::find($id)->delete();
        return redirect()->route('restaurant.food.index');
    }
}
