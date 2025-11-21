<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::middleware('guest')->group(function () {

    // halaman login-register gabungan
    Route::get('/auth', [AuthController::class, 'showAuthPage'])->name('auth.show');

    // proses login
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    // proses register
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

Route::middleware('auth')->group(function () {

    Route::get('/home', function () {
        return view('home');
    })->name('home');

    // logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// default redirect
Route::get('/', function () {
    return redirect('/auth');
});
