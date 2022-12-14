<?php
// Admin Routes place here except for authentication . That was in auth
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\Auth\AdminRegisterController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\DeleteCommentController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\FoodCategoryController;
use App\Http\Controllers\Admin\RestaurantCategoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('/admin')->name('admin.')->middleware(['isAdmin'])->group(function (){
    Route::get('/',function (){
        return view('admin.dashboard');
    })->name('dashboard');
    Route::resource('/foodCategory',FoodCategoryController::class);
    Route::resource('/restaurantCategory',RestaurantCategoryController::class);
    Route::resource('/discount',DiscountController::class);
    Route::get('/comments/',[DeleteCommentController::class,'index'])->name('comment.index');
    Route::delete('/comments/{comment}',[DeleteCommentController::class,'delete'])->name('comment.delete');
    Route::patch('comments/{comment}',[DeleteCommentController::class,'accept'])->name('comment.accept');
    Route::resource('/banner',BannerController::class);
});
Route::prefix('/admin')->name('admin.')->middleware('isNotAdmin')->group(function (){
    Route::get('login',[AdminLoginController::class,'create'])->name('login');
    Route::post('login',[AdminLoginController::class,'store'])->name('login.store');
    Route::get('register',[AdminRegisterController::class,'create'])->name('register');
    Route::post('register',[AdminRegisterController::class,'store'])->name('register.store');
});
Route::post('/admin/logout',[AdminLoginController::class,'destroy'])->middleware('isAdmin')->name('admin.logout');
