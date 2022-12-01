<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DiscountRequest;
use App\Models\admin\Discount;
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
     * @param  \App\Models\admin\Discount  $discount
     * @return Discount
     */
    public function show(Discount $discount)
    {
        return $discount;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\admin\Discount  $discount
     * @return View
     */

    public function edit(Discount $discount)
    {
        return view('admin.discount.editDiscount',compact('discount'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  DiscountRequest  $request
     * @param  Discount  $discount
     * @return RedirectResponse
     */
    public function update(DiscountRequest $request, Discount $discount)
    {
        $discount->update($request->all());
        return redirect()->route('admin.discount.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\admin\Discount  $discount
     * @return RedirectResponse
     */
    public function destroy(Discount $discount)
    {
        $discount->delete();
        return redirect()->route('admin.discount.index');
    }

}
