<?php

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
    Route::get('/show',[UserController::class,'show'])->name('show');
    Route::put('/edit', [UserController::class, 'update'])->name('update');
    Route::delete('/delete',[UserController::class,'destroy'])->name('delete');
    Route::post('/logout',[UserController::class,'logout'])->name('logout');
});
//Route::resource('user',UserController::class);
