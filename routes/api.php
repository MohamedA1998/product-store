<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\ProductApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::apiResource('product', ProductApiController::class);


Route::controller(AuthApiController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('logout', 'logout');
});
