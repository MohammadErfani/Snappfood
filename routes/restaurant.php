<?php
// Admin Routes place here except for authentication . That was in auth
use App\Http\Controllers\restaurant\FoodController;
use App\Http\Controllers\restaurant\RestaurantController;
use Illuminate\Support\Facades\Route;

Route::prefix('/restaurant')->name('restaurant.')->middleware(['isSalesman','authRestaurant'])->group(function (){
    Route::get('/',[RestaurantController::class,'index'])->name('dashboard');
    Route::put('/',[RestaurantController::class,'update'])->name('update');
    Route::get('/edit',[RestaurantController::class,'edit'])->name('edit');
    Route::delete('/',[RestaurantController::class,'destroy'])->name('destroy');
    Route::get('/show',[RestaurantController::class,'show'])->name('show');

    Route::resource('/food',FoodController::class);

});
Route::get('/restaurant/create',[RestaurantController::class,'create'])->middleware(['isSalesman'])->name('restaurant.create');
Route::post('/restaurant',[RestaurantController::class,'store'])->middleware(['isSalesman'])->name('restaurant.store');
//
//Route::resource('/restaurant',RestaurantController::class);
