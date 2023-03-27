<?php

// Authentication Routes...

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [LoginController::class, 'login']);
Route::middleware(['auth:api'])->group(function () {
    Route::post('logout', [LoginController::class, 'logout']);
    Route::post('logout-from-all-other-device', [LoginController::class, 'logoutFromAllOtherDevice']);

    Route::get('user', [UserController::class, 'getDetails']);
    Route::get('user/verified-at', [UserController::class, 'checkStatus']);
});
