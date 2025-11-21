<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Route untuk Guest
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {

    // halaman login-register gabungan
    Route::get('/auth', [AuthController::class, 'showAuthPage'])->name('auth.show');

    // proses login
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    // proses register
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});


/*
|--------------------------------------------------------------------------
| Route untuk User Login
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // halaman home user
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    // logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


/*
|--------------------------------------------------------------------------
| Route ADMIN
|--------------------------------------------------------------------------
|
| Semua route admin berada di bawah prefix /admin
| dan hanya bisa diakses user yang sudah login.
|
| Jika kamu ingin khusus role admin nanti kita bisa tambah middleware admin.
|
*/
Route::middleware(['auth'])->prefix('admin')->group(function () {

    // Dashboard Admin (pakai controller AdminController)
    Route::get('/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    // Tambahan route admin lainnya dapat kamu tambahkan di sini
    // Route::get('/services', [AdminController::class, 'services'])->name('admin.services');
});


/*
|--------------------------------------------------------------------------
| Default Redirect
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect('/auth');
});
