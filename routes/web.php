<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::get('/', fn () => to_route('auth.signin'));



Route::middleware('admin')->name('admin.')->group(function () {
    Route::get('dashboard', fn () => view('admin.dashboard.index'))->name('dashboard');

    Route::resource('product', ProductController::class)->except('show');
});


Route::controller(AuthController::class)->name('auth.')->group(function () {
    Route::get('signin', 'signin')->name('signin');
    Route::post('login', 'login')->name('login');
    Route::delete('logout', 'logout')->name('logout');
});
