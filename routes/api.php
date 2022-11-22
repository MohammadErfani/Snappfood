<?php

use App\Http\Controllers\user\AddressController;
use App\Http\Controllers\user\auth\UserController;
use App\Http\Controllers\user\GetRestaurantController;
use App\Http\Controllers\user\CartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// user crud routs
Route::post('/user/register', [UserController::class, 'store'])->name('user.register');
Route::post('/user/login', [UserController::class, 'login'])->name('user.login');

Route::prefix('user')->name('user.')->middleware('auth:sanctum')->group(function () {
    Route::get('/show', [UserController::class, 'show'])->name('show');
    Route::put('/edit', [UserController::class, 'update'])->name('update');
    Route::delete('/delete', [UserController::class, 'destroy'])->name('delete');
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});
// resource routes for user address
Route::prefix('addresses')->name('address.')->middleware('auth:sanctum')->group(function () {
    Route::get('/',[AddressController::class,'index'])->name('index');
    Route::post('/',[AddressController::class,'store'])->name('store');
    Route::get('/{address}',[AddressController::class,'show'])->name('show');
    Route::put('/{address}',[AddressController::class,'update'])->name('update');
    Route::delete('/{address}',[AddressController::class,'destroy'])->name('delete');
    Route::patch('/{address}/setCurrent',[AddressController::class,'setCurrent'])->name('setCurrent');
});

// get restaurant routes
Route::prefix('/restaurants')->name('restaurants.')->middleware('auth:sanctum')->group(function (){
    Route::get('/',[GetRestaurantController::class,'index'])->name('index');
    Route::get('/{restaurant}',[GetRestaurantController::class,'show'])->name('show');
    Route::get('/{restaurant}/foods',[GetRestaurantController::class,'foods'])->name('foods');
    Route::get('/{restaurant}/foods/category/{foodCategory}',[GetRestaurantController::class,'categoryFoods'])->name('categoryFoods');
    Route::get('/{restaurant}/foods/{food}',[GetRestaurantController::class,'showFood'])->name('showFoods');
});
Route::prefix('/carts')->name('carts.')->middleware('auth:sanctum')->group(function (){
    Route::get('/',[CartController::class,'index'])->name('index');
    Route::post('/add',[CartController::class,'store'])->name('store');
    Route::get('/{order}/show',[CartController::class,'show'])->name('show');
    Route::patch('/add',[CartController::class,'update'])->name('update');
    Route::delete('/add',[CartController::class,'destroy'])->name('destroy');
    Route::delete('/add/{food}',[CartController::class,'deleteFood'])->name('deleteFood');
});
