<?php

use App\Http\Controllers\User\AddressController;
use App\Http\Controllers\User\auth\UserController;
use App\Http\Controllers\User\CommentController;
use App\Http\Controllers\User\GetRestaurantController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\WalletController;
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

Route::middleware('auth:sanctum')->group(function () {

// User Routes
    Route::prefix('user')->name('user.')->middleware('auth:sanctum')->group(function () {
        Route::get('/show', [UserController::class, 'show'])->name('show');
        Route::put('/edit', [UserController::class, 'update'])->name('update');
        Route::delete('/delete', [UserController::class, 'destroy'])->name('delete');
        Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    });
// resource routes for user address
    Route::prefix('addresses')->name('address.')->group(function () {
        Route::get('/', [AddressController::class, 'index'])->name('index');
        Route::post('/', [AddressController::class, 'store'])->name('store');
        Route::get('/{address}', [AddressController::class, 'show'])->name('show');
        Route::put('/{address}', [AddressController::class, 'update'])->name('update');
        Route::delete('/{address}', [AddressController::class, 'destroy'])->name('delete');
        Route::patch('/{address}/setCurrent', [AddressController::class, 'setCurrent'])->name('setCurrent');
    });
// Route for add and check for wallet
    Route::prefix('/wallet')->name('wallet.')->group(function () {
        Route::patch('/', [WalletController::class, 'add'])->name('add');
        Route::get('/', [WalletController::class, 'show'])->name('show');
    });
// get restaurant routes
    Route::prefix('/restaurants')->name('restaurants.')->group(function () {
        Route::get('/', [GetRestaurantController::class, 'index'])->name('index');
        Route::get('/{restaurant}', [GetRestaurantController::class, 'show'])->name('show');
        Route::get('/{restaurant}/foods', [GetRestaurantController::class, 'foods'])->name('foods');
        Route::get('/{restaurant}/foods/category/{foodCategory}', [GetRestaurantController::class, 'categoryFoods'])->name('categoryFoods');
        Route::get('/{restaurant}/foods/{food}', [GetRestaurantController::class, 'showFood'])->name('showFoods');
    });
    Route::prefix('/carts')->name('carts.')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/add', [CartController::class, 'store'])->name('store');
        Route::get('/show/{order}', [CartController::class, 'show'])->name('show');
        Route::patch('/add', [CartController::class, 'update'])->name('update');
        Route::delete('/add', [CartController::class, 'destroy'])->name('destroy');
        Route::delete('/add/{food}', [CartController::class, 'deleteFood'])->name('deleteFood');
//    Route::post('/{order}/pay',[CartController::class,'pay'])->name('pay');
        Route::post('/pay', [CartController::class, 'pay'])->name('pay');
        Route::get('/active', [CartController::class, 'showActive'])->name('showActive');
    });


    Route::prefix('/comments')->name('comments.')->group(function () {
        Route::get('/', [CommentController::class, 'foodComments'])->name('foodComments');
        Route::post('/', [CommentController::class, 'store'])->name('store');
        Route::get('/sent',[CommentController::class,'showUserComments'])->name('ShowUserComments');
    });
});
