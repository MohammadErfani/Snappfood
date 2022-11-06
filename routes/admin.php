<?php
// Admin Routes place here except for authentication . That was in auth
use App\Http\Controllers\admin\Auth\AdminLoginController;
use App\Http\Controllers\admin\Auth\AdminRegisterController;
use App\Http\Controllers\admin\DiscountController;
use App\Http\Controllers\admin\FoodCategoryController;
use App\Http\Controllers\admin\RestaurantCategoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('/admin')->name('admin.')->middleware(['isAdmin'])->group(function (){
    Route::get('/',function (){
        return view('admin.dashboard');
    })->name('dashboard');
    Route::resource('/foodCategory',FoodCategoryController::class);
    Route::resource('/restaurantCategory',RestaurantCategoryController::class);
    Route::resource('/discount',DiscountController::class);
});
Route::prefix('/admin')->name('admin.')->middleware('isNotAdmin')->group(function (){
    Route::get('login',[AdminLoginController::class,'create'])->name('login');
    Route::post('login',[AdminLoginController::class,'store'])->name('login.store');
    Route::get('register',[AdminRegisterController::class,'create'])->name('register');
    Route::post('register',[AdminRegisterController::class,'store'])->name('register.store');
});
Route::post('/admin/logout',[AdminLoginController::class,'destroy'])->middleware('isAdmin')->name('admin.logout');
