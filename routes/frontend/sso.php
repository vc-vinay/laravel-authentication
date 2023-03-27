<?php

// SSO Routes...

use App\Http\Controllers\SSO\SSOController;
use Illuminate\Support\Facades\Route;

Route::get('sso/login', [SSOController::class, 'getLogin'])->name('sso.login');
Route::get('auth/callback', [SSOController::class, 'getCallback'])->name('sso.callback');
Route::get('sso/connect', [SSOController::class, 'getUser'])->name('sso.connect');
