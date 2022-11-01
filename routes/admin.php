<?php
// Admin Routes place here except for authentication . That was in auth
use Illuminate\Support\Facades\Route;

Route::prefix('/admin')->name('admin.')->middleware(['isAdmin'])->group(function (){
    Route::get('/',function (){
        return view('admin.dashboard');
    })->name('dashboard');
});
