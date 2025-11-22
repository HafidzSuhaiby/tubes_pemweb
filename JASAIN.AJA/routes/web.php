<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\ServiceRegistrationController;
use App\Http\Controllers\Admin\ServiceRegistrationAdminController;


/*
|--------------------------------------------------------------------------
| Route untuk Guest
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {

    // halaman login-register gabungan
    Route::get('/auth', [AuthController::class, 'showAuthPage'])->name('auth.show');

    // redirect login lama
    Route::get('/login', function () {
        return redirect()->route('auth.show');
    });

    // proses login
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    // proses register
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});


/*
|--------------------------------------------------------------------------
| Route Daftar Jasa (GET)
|--------------------------------------------------------------------------
*/
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

    // simpan pendaftaran jasa
    Route::post('/daftar-jasa/store', 
        [ServiceRegistrationController::class, 'store']
    )->name('daftar-jasa.store');

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
    
    // ================== ADMIN : DATA PENDAFTAR JASA ==================
    Route::get('/pendaftar-jasa', 
        [ServiceRegistrationAdminController::class, 'index']
    )->name('pendaftar-jasa');

    Route::get('/pendaftar-jasa/{id}', [ServiceRegistrationAdminController::class, 'show'])
        ->name('pendaftar-jasa.show');

    Route::post('/pendaftar-jasa/{id}/approve', 
        [ServiceRegistrationAdminController::class, 'approve']
    )->name('pendaftar-jasa.approve');

    Route::post('/pendaftar-jasa/{id}/reject', 
        [ServiceRegistrationAdminController::class, 'reject']
    )->name('pendaftar-jasa.reject');
});


/*
|--------------------------------------------------------------------------
| Default Redirect
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect('/auth');
});
