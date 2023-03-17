<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::prefix(config('project.admin_prefix'))->namespace('Admin')->name('admin.')->group(function () {
    Auth::routes(['register' => false]);
});

Route::prefix(config('project.writer_prefix'))->namespace('Writer')->name('writer.')->group(function () {
    Auth::routes(['register' => false]);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

// Route::get('/login/admin', [App\Http\Controllers\Auth\LoginController::class, 'showAdminLoginForm'])->name('admin.login');
// Route::get('/login/writer', [App\Http\Controllers\Auth\LoginController::class, 'showWriterLoginForm'])->name('writer.login');
// Route::get('/register/admin', [App\Http\Controllers\Auth\RegisterController::class, 'showAdminRegisterForm'])->name('admin.register');
// Route::get('/register/writer', [App\Http\Controllers\Auth\RegisterController::class, 'showWriterRegisterForm'])->name('writer.register');

// Route::post('/login/admin', [App\Http\Controllers\Auth\LoginController::class, 'adminLogin']);
// Route::post('/login/writer', [App\Http\Controllers\Auth\LoginController::class, 'writerLogin']);
// Route::post('/register/admin', [App\Http\Controllers\Auth\RegisterController::class, 'createAdmin']);
// Route::post('/register/writer', [App\Http\Controllers\Auth\RegisterController::class, 'createWriter']);

Route::view('/admin', 'admin')->middleware('auth:admin');
Route::view('/writer', 'writer')->middleware('auth:writer');