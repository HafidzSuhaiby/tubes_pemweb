<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\ServiceRegistrationController;
use App\Http\Controllers\Admin\ServiceRegistrationAdminController;
use App\Http\Controllers\JasaController;
use App\Http\Controllers\TentangKamiController;
use App\Http\Controllers\BookingController;
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
| Route untuk User Login
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // halaman home user
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    // halaman daftar jasa (form multi step + status)
    Route::get('/daftar-jasa',
        [ServiceRegistrationController::class, 'create']
    )->name('daftar-jasa');

    // simpan pendaftaran jasa
    Route::post('/daftar-jasa/store',
        [ServiceRegistrationController::class, 'store']
    )->name('daftar-jasa.store');

    // halaman "Jasa Saya" untuk role penyedia
    Route::get('/jasa-saya',
        [ServiceRegistrationController::class, 'myService']
    )->name('jasa-saya');

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
    // LIST / INDEX
    Route::get('/pendaftar-jasa',
        [ServiceRegistrationAdminController::class, 'index']
    )->name('pendaftar-jasa');

    // DETAIL
    Route::get('/pendaftar-jasa/{id}',
        [ServiceRegistrationAdminController::class, 'show']
    )->name('pendaftar-jasa.show');

    // APPROVE → pakai ServiceRegistrationController (ubah status + role)
    Route::post('/pendaftar-jasa/{id}/approve',
        [ServiceRegistrationController::class, 'approve']
    )->name('pendaftar-jasa.approve');

    // REJECT
    Route::post('/pendaftar-jasa/{id}/reject',
        [ServiceRegistrationAdminController::class, 'reject']
    )->name('pendaftar-jasa.reject');

    // DELETE DATA PENDAFTAR (misal kalau ditolak)
    Route::delete('/pendaftar-jasa/{id}',
        [ServiceRegistrationAdminController::class, 'destroy']
    )->name('pendaftar-jasa.destroy');

     // ================== ADMIN : DATA JASA DISETUJUI ==================
    Route::get('/data-jasa',
        [ServiceRegistrationAdminController::class, 'approvedIndex']
    )->name('data-jasa.index');

    Route::post('/data-jasa/{id}/toggle-active',
        [ServiceRegistrationAdminController::class, 'toggleActive']
    )->name('data-jasa.toggle');

    // DETAIL
    Route::get('/data-jasa/{id}',
        [ServiceRegistrationAdminController::class, 'showApproved']
    )->name('data-jasa.show');

});

Route::get('/jasa', [JasaController::class, 'index'])->name('jasa.index');
/*
|--------------------------------------------------------------------------
| Default Redirect
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect('/auth');
});

Route::get('/tentang', [TentangKamiController::class, 'index'])
     ->name('tentang');

     Route::get('/booking', [BookingController::class, 'index'])->name('booking');
