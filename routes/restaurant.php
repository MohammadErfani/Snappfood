<?php
// Admin Routes place here except for authentication . That was in auth
use App\Http\Controllers\restaurant\Auth\SalesmanLoginController;
use App\Http\Controllers\restaurant\Auth\SalesmanRegisterController;
use App\Http\Controllers\restaurant\FoodController;
use App\Http\Controllers\restaurant\RestaurantController;
use Illuminate\Support\Facades\Route;

// authentication
Route::prefix('/salesman')->name('salesman.')->middleware('isNotSalesman')->group(function (){
    Route::get('login',[SalesmanLoginController::class,'create'])->name('login');
    Route::post('login',[SalesmanLoginController::class,'store'])->name('login.store');
    Route::get('register',[SalesmanRegisterController::class,'create'])->name('register');
    Route::post('register',[SalesmanRegisterController::class,'store'])->name('register.store');
});
Route::post('/salesman/logout',[SalesmanLoginController::class,'destroy'])->middleware('isSalesman')->name('salesman.logout');


Route::prefix('/restaurant')->name('restaurant.')->middleware(['isSalesman','authRestaurant'])->group(function (){
    Route::get('/',[RestaurantController::class,'index'])->name('dashboard');
    Route::put('/',[RestaurantController::class,'update'])->name('update');
    Route::get('/edit',[RestaurantController::class,'edit'])->name('edit');
    Route::delete('/',[RestaurantController::class,'destroy'])->name('destroy');
    Route::get('/show',[RestaurantController::class,'show'])->name('show');
    Route::patch('/edit',[RestaurantController::class,'changeStatus'])->name('status');

    Route::resource('/food',FoodController::class);

});
Route::get('/restaurant/create',[RestaurantController::class,'create'])->middleware(['isSalesman'])->name('restaurant.create');
Route::post('/restaurant',[RestaurantController::class,'store'])->middleware(['isSalesman'])->name('restaurant.store');
//
//Route::resource('/restaurant',RestaurantController::class);
