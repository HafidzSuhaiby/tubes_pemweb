<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserManagementController;

/*
|--------------------------------------------------------------------------
| Route untuk Guest
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {

    // halaman login-register gabungan
    Route::get('/auth', [AuthController::class, 'showAuthPage'])->name('auth.show');

    // ❗ TAMBAHKAN BAGIAN INI
    Route::get('/login', function () {
        return redirect()->route('auth.show');
    });

    // proses login
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    // proses register
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});


Route::get('/daftar-jasa', function () {
    return view('daftar-jasa');
})->name('daftar-jasa');
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
*/
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', [AdminController::class, 'dashboard'])
        ->name('dashboard');

    // ================== ADMIN : DATA PENGGUNA ==================
    Route::resource('users', UserManagementController::class)
        ->except(['show', 'create', 'store']);
});


/*
|--------------------------------------------------------------------------
| Default Redirect
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect('/auth');
});
