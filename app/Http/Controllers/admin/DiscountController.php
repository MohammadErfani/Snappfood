<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DiscountRequest;
use App\Http\Resources\DiscountResource;
use App\Models\Discount;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $discounts = Discount::all();

        return view('admin.discount.discounts',compact('discounts'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('admin.discount.createDiscount');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  DiscountRequest  $request
     * @return RedirectResponse
     */
    public function store(DiscountRequest $request)
    {
        Discount::create($request->all());
        return redirect()->route('admin.discount.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function edit($id)
    {
        return view('admin.discount.editDiscount',['discount'=>Discount::find($id)->first()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  DiscountRequest  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(DiscountRequest $request, $id)
    {
        Discount::find($id)->update($request->all());
        return redirect()->route('admin.discount.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        Discount::find($id)->delete();
        return redirect()->route('admin.discount.index');

    }
}
