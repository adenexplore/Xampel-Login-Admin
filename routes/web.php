<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome'); // Mengarahkan ke view welcome.blade.php
});


Route::get('/login', [AuthController::class, 'login']);
Route::post('/postlogin', [AuthController::class, 'postlogin']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::view('/forgot-password', 'auth.forgot-password');

// Forgot Password Routes
Route::post('/forgot-password', [AuthController::class, 'sendResetLink']);
Route::get('/reset-password', [AuthController::class, 'showResetForm']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);
Route::get('/success', function () {
    return view('auth.success');
})->name('success-page');


Route::group(['middleware' => ['auth', 'checkRole:admin']], function () {
    Route::get('/dashboard', function () {
        return view('dashboard'); // Tidak perlu '/' di depan 'dashboard'
    });
});


require __DIR__.'/auth.php';
