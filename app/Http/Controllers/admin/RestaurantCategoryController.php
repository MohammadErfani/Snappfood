<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\admin\FoodCategory;
use App\Models\admin\RestaurantCategory;
use Illuminate\Http\Request;

class RestaurantCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $restaurantCategories = RestaurantCategory::all();
        return view('admin.restaurantCategories',compact('restaurantCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $restaurantCategories = RestaurantCategory::all();
        return view('admin.createRestaurantCategory',compact('restaurantCategories'));
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        return view('admin.editFoodCategory',['foodCategory'=>RestaurantCategory::find($id),'parentCategories'=>RestaurantCategory::all()]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \app\Http\Requests\CategoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoryRequest $request, $id)
    {
        if($request->file('picture')!== null){
            $picturePath = $request->file('picture')->store('uploads/restaurantCategories');
            RestaurantCategory::where('id',$id)->update(['picture'=>$picturePath]);
        }
        RestaurantCategory::where('id',$id)->update(['name'=>$request->name,'parent_category'=>$request->parentCategory]);
        return redirect()->route('admin.restaurantCategory.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        RestaurantCategory::find($id)->delete();
        return redirect()->route('admin.restaurantCategory.index');
    }
}
