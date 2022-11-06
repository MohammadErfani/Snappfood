<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\admin\FoodCategory;
use App\Models\restaurant\Food;
use Illuminate\Http\Request;

class FoodCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $foodCategories = FoodCategory::all();
        return view('admin.foodCategory.foodCategories',compact('foodCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $foodCategories = FoodCategory::all();
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *@return \Illuminate\View\View

     */
    public function edit($id)
    {
        return view('admin.foodCategory.editFoodCategory',['foodCategory'=>FoodCategory::find($id),'parentCategories'=>FoodCategory::all()]);
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
            $picturePath = $request->file('picture')->store('uploads/foodCategories');
            FoodCategory::where('id',$id)->update(['picture'=>$picturePath]);
        }
        FoodCategory::where('id',$id)->update(['name'=>$request->name,'parent_category'=>$request->parentCategory]);
        return redirect()->route('admin.foodCategory.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        FoodCategory::find($id)->delete();
        return redirect()->route('admin.foodCategory.index');

    }
}
