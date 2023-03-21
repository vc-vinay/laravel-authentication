<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * Authentication route
 */
Route::post('login', [LoginController::class, 'login']);
Route::middleware(['auth:sanctum'])->group( function() {
    Route::post('logout', [LoginController::class, 'logout']);
    Route::post('logout-from-all-other-device', [LoginController::class, 'logoutFromAllOtherDevice']);

    Route::get('user', [UserController::class, 'getDetails']);
    Route::get('user/verified-at', [UserController::class, 'checkStatus']);
});