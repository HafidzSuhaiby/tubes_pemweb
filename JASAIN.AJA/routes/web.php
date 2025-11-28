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
use App\Http\Controllers\HomePenjualController;
use App\Http\Controllers\Admin\OrderAdminController;
use App\Http\Controllers\CartController;

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

    Route::get(
        '/profile',
        [UserManagementController::class, 'editProfile']
    )->name('profile.edit');

    Route::put(
        '/profile',
        [UserManagementController::class, 'updateProfile']
    )->name('profile.update');
    
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

    Route::get('/jasa-saya',
        [HomePenjualController::class, 'index']
    )->name('jasa-saya');

    // halaman keranjang
    Route::get('/cart', [CartController::class, 'index'])
        ->name('cart.index');

    // tambah item ke keranjang (dari modal booking)
    Route::post('/cart/add', [CartController::class, 'store'])
        ->name('cart.add');

    // checkout keranjang → buat pesanan
    Route::post('/cart/checkout', [CartController::class, 'checkout'])
        ->name('cart.checkout');


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
    // DETAIL PENDAFTAR JASA
    Route::get('/pendaftar-jasa/{id}',
        [ServiceRegistrationAdminController::class, 'show']
    )->name('pendaftar-jasa.show');
    // ================== ADMIN : DATA PESANAN ==================
    Route::get('/data-pesanan', [OrderAdminController::class, 'index'])
        ->name('orders.index');

    Route::get('/data-pesanan/{order}', [OrderAdminController::class, 'show'])
        ->name('orders.show');


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

     Route::get('/penjual-home', [HomePenjualController::class, 'index']);

     // halaman "pesanan saya" user
Route::get('/booking', [BookingController::class, 'index'])
    ->middleware('auth')
    ->name('booking');

// user membuat pesanan baru
Route::post('/booking', [BookingController::class, 'store'])
    ->middleware('auth')
    ->name('booking.store');

// update status pesanan (dipakai penyedia dan admin)
Route::put('/orders/{order}/status', [BookingController::class, 'updateStatus'])
    ->middleware('auth')
    ->name('orders.update-status');
