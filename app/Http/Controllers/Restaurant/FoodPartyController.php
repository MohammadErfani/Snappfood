<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Http\Requests\FoodPartyRequest;
use App\Models\FoodParty;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FoodPartyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param FoodPartyRequest $request
     * @return RedirectResponse
     */
    public function store(FoodPartyRequest $request)
    {
        if (empty($foodParty = FoodParty::where('food_id', $request->food_id)->first())) {
            FoodParty::create([
                "food_id" => $request->food_id,
                "discount_id" => $request->foodPartyDiscount,
                'food_count' => $request->count
            ]);
        }else{
            $foodParty->update([
                'food_count'=>$request->count,
                'discount_id'=>$request->foodPartyDiscount
            ]);
        }
        return redirect()->route('restaurant.food.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\FoodParty $foodParty
     * @return \Illuminate\Http\Response
     */
    public function destroy(FoodParty $foodParty)
    {
        $foodParty->delete();
        return redirect()->route('restaurant.food.index');
    }
}
