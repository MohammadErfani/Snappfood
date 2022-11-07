<?php

use App\Http\Controllers\user\auth\AddressController;
use App\Http\Controllers\user\auth\UserController;
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

Route::post('/user/register', [UserController::class, 'store'])->name('user.register');
Route::post('/user/login', [UserController::class, 'login'])->name('user.login');

Route::prefix('user')->name('user.')->middleware('auth:sanctum')->group(function () {
    Route::get('/show', [UserController::class, 'show'])->name('show');
    Route::put('/edit', [UserController::class, 'update'])->name('update');
    Route::delete('/delete', [UserController::class, 'destroy'])->name('delete');
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});
Route::prefix('addresses')->name('address.')->middleware('auth:sanctum')->group(function () {
    Route::get('/',[AddressController::class,'index'])->name('index');
    Route::post('/',[AddressController::class,'store'])->name('store');
    Route::get('/{address}',[AddressController::class,'show'])->name('show');
    Route::put('/{address}',[AddressController::class,'update'])->name('update');
    Route::delete('/{address}',[AddressController::class,'destroy'])->name('delete');
    Route::patch('/{address}/setCurrent',[AddressController::class,'setCurrent'])->name('setCurrent');
});
//Route::resource('user',UserController::class);
