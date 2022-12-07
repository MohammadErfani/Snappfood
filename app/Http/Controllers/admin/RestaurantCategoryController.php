<?php

namespace App\Http\Controllers\admin;

use Facades\App\Caching\RestaurantCategories;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\admin\RestaurantCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RestaurantCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $restaurantCategories = RestaurantCategories::all();
        return view('admin.restaurantCategory.restaurantCategories',compact('restaurantCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $restaurantCategories = RestaurantCategories::all();
        return view('admin.restaurantCategory.createRestaurantCategory',compact('restaurantCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \app\Http\Requests\CategoryRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryRequest $request)
    {
        if ($request->file('picture')===null){
            $picturePath = null;
        }else {
            $picturePath = $request->file('picture')->store('uploads/restaurantCategories');
        }
        RestaurantCategory::create([
            'name'=>$request->name,
            'parent_category'=>$request->parentCategory,
            'picture'=>$picturePath
        ]);
        return redirect()->route('admin.restaurantCategory.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\admin\RestaurantCategory  $restaurantCategory
     * @return RestaurantCategory
     */
    public function show(RestaurantCategory $restaurantCategory)
    {
        return $restaurantCategory;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\admin\RestaurantCategory  $restaurantCategory
     * @return View
     */
    public function edit(RestaurantCategory $restaurantCategory)
    {
        return view('admin.restaurantCategory.editRestaurantCategory',['restaurantCategory'=>$restaurantCategory,'parentCategories'=>RestaurantCategory::all()]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\admin\RestaurantCategory  $restaurantCategory
     * @return RedirectResponse
     */
    public function update(Request $request, RestaurantCategory $restaurantCategory)
    {
        if($request->file('picture')!== null){
            $picturePath = $request->file('picture')->store('uploads/restaurantCategories');
            $restaurantCategory->update(['picture'=>$picturePath]);
        }
        $restaurantCategory->update(['name'=>$request->name,'parent_category'=>$request->parentCategory]);
        return redirect()->route('admin.restaurantCategory.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\admin\RestaurantCategory  $restaurantCategory
     * @return RedirectResponse
     */
    public function destroy(RestaurantCategory $restaurantCategory)
    {
        $restaurantCategory->delete();
        return redirect()->route('admin.restaurantCategory.index');
    }
}
