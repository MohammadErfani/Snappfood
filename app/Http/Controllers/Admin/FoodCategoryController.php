<?php

namespace App\Http\Controllers\Admin;

use Facades\App\Caching\FoodCategories;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Admin\FoodCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FoodCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $foodCategories = FoodCategories::all();
        return view('admin.foodCategory.foodCategories',compact('foodCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $foodCategories = FoodCategories::all();
        return view('admin.foodCategory.createFoodCategory',compact('foodCategories'));
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
            $picturePath = $request->file('picture')->store('uploads/foodCategories');
        }
        FoodCategory::create([
            'name'=>$request->name,
            'parent_category'=>$request->parentCategory,
            'picture'=>$picturePath
        ]);
        return redirect()->route('admin.foodCategory.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  FoodCategory  $foodCategory
     * @return FoodCategory
     */
    public function show(FoodCategory $foodCategory)
    {
        return $foodCategory;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\FoodCategory  $foodCategory
     * @return View
     */
    public function edit(FoodCategory $foodCategory)
    {
        return view('admin.foodCategory.editFoodCategory',['foodCategory'=>$foodCategory,'parentCategories'=>FoodCategories::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CategoryRequest  $request
     * @param  \App\Models\Admin\FoodCategory  $foodCategory
     * @return RedirectResponse
     */
    public function update(CategoryRequest $request, FoodCategory $foodCategory)
    {
        if($request->file('picture')!== null){
            $picturePath = $request->file('picture')->store('uploads/foodCategories');
            $foodCategory->update(['picture'=>$picturePath]);
        }
        $foodCategory->update(['name'=>$request->name,'parent_category'=>$request->parentCategory]);
        return redirect()->route('admin.foodCategory.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\FoodCategory  $foodCategory
     * @return RedirectResponse
     */
    public function destroy(FoodCategory $foodCategory)
    {
        $foodCategory->delete();
        return redirect()->route('admin.foodCategory.index');

    }
}
