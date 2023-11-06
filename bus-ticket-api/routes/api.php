<?php

use App\Http\Controllers\API\V1\AdminController;
use App\Http\Controllers\API\V1\DriverController;
use App\Http\Controllers\API\V1\UserController;
use App\Http\Controllers\Auth\AuthenticationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

/**
 * ROUTES API FOR BUS TICKETS
 */

Route::post('/register',[AuthenticationController::class, 'register']);
Route::post('/login',[AuthenticationController::class, 'login']);

Route::middleware(['auth:api', 'auth-admin'])->prefix('v1/admin')->group(function () {
    // Các route dành cho quản trị viên
    Route::get('/dashboard',[AdminController::class, 'index']);

    
    Route::post('/logout', [AuthenticationController::class, 'logout']);
    // Thêm các route khác cho quản trị viên
});


Route::middleware(['auth:api', 'auth-user'])->prefix('v1/customer')->group(function () {
    // Các route dành cho khách hàng thành viên
    Route::get('/account',[UserController::class, 'index']);



    Route::post('/logout', [AuthenticationController::class, 'logout']);
    // Thêm các route khác cho khách hàng thành viên
});
