<?php
// Admin Routes place here except for authentication . That was in auth
use App\Http\Controllers\restaurant\RestaurantController;
use Illuminate\Support\Facades\Route;

Route::prefix('/restaurant')->name('restaurant.')->middleware(['isSalesman','authRestaurant'])->group(function (){
    Route::get('/',function (){
        return view('restaurant.dashboard');
    })->name('dashboard');
});
Route::get('/restaurant/create',[RestaurantController::class,'create'])->middleware(['isSalesman'])->name('restaurant.create');
Route::post('/restaurant',[RestaurantController::class,'store'])->middleware(['isSalesman'])->name('restaurant.store');
//
//Route::resource('/restaurant',RestaurantController::class);
