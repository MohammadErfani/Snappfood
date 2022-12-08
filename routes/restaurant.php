<?php
// Admin Routes place here except for authentication . That was in auth
use App\Http\Controllers\Restaurant\Auth\SalesmanLoginController;
use App\Http\Controllers\Restaurant\Auth\SalesmanRegisterController;
use App\Http\Controllers\Restaurant\CommentController;
use App\Http\Controllers\Restaurant\FoodController;
use App\Http\Controllers\Restaurant\FoodPartyController;
use App\Http\Controllers\Restaurant\OrderController;
use App\Http\Controllers\Restaurant\ReportController;
use App\Http\Controllers\Restaurant\RestaurantController;
use App\Models\FoodParty;
use Illuminate\Support\Facades\Route;

// authentication
Route::prefix('/salesman')->name('salesman.')->middleware('isNotSalesman')->group(function () {
    Route::get('login', [SalesmanLoginController::class, 'create'])->name('login');
    Route::post('login', [SalesmanLoginController::class, 'store'])->name('login.store');
    Route::get('register', [SalesmanRegisterController::class, 'create'])->name('register');
    Route::post('register', [SalesmanRegisterController::class, 'store'])->name('register.store');
});
Route::post('/salesman/logout', [SalesmanLoginController::class, 'destroy'])->middleware('isSalesman')->name('salesman.logout');


Route::prefix('/restaurant')->name('restaurant.')->middleware(['isSalesman', 'authRestaurant'])->group(function () {
    Route::get('/', [RestaurantController::class, 'index'])->name('dashboard');
    Route::put('/', [RestaurantController::class, 'update'])->name('update');
    Route::get('/edit', [RestaurantController::class, 'edit'])->name('edit');
    Route::delete('/', [RestaurantController::class, 'destroy'])->name('destroy');
    Route::get('/show', [RestaurantController::class, 'show'])->name('show');
    Route::patch('/edit', [RestaurantController::class, 'changeStatus'])->name('status');

    Route::resource('/food', FoodController::class);
    Route::resource('/foodParty',FoodPartyController::class);
    Route::prefix('order')->name('order.')->group(function () {
        Route::get('/show/{order}', [OrderController::class, 'show'])->name('show');
        Route::patch('/accept/{order}',[OrderController::class,'accept'])->name('accept');
        Route::patch('/reject/{order}',[OrderController::class,'reject'])->name('reject');
        Route::patch('/sending/{order}',[OrderController::class,'sending'])->name('sending');
        Route::patch('/delivered/{order}',[OrderController::class,'delivered'])->name('delivered');
        Route::get('/archive',[OrderController::class,'archive'])->name('archive');
    });

    Route::prefix('/comments')->name('comment.')->group(function(){
        Route::get('/',[CommentController::class,'index'])->name('index');
        Route::patch('/accept/{comment}',[CommentController::class,'accept'])->name('accept');
        Route::patch('/delete/{comment}',[CommentController::class,'delete'])->name('delete');
        Route::patch('/answer/{comment}',[CommentController::class,'answer'])->name('answer');
    });
    Route::prefix('/report')->name('report.')->group(function (){
        Route::get('/{year?}',function ($year=2022){
            $controller = new ReportController();
            return $controller->index($year);
        })->name('index');
        Route::get('/export/excel',[ReportController::class,'export'])->name('export');
        Route::post('/filter',[ReportController::class,'filterYear'])->name('filterYear');
        Route::post('/filter-between',[ReportController::class,'filterBetween'])->name('filterBetween');
    });
});
Route::get('/restaurant/create', [RestaurantController::class, 'create'])->middleware(['isSalesman'])->name('restaurant.create');
Route::post('/restaurant', [RestaurantController::class, 'store'])->middleware(['isSalesman'])->name('restaurant.store');
//
//Route::resource('/restaurant',RestaurantController::class);
