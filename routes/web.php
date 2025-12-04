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
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\WalletController;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('home')
        : redirect()->route('auth.show');
});

/*
|--------------------------------------------------------------------------
| ROUTE PUBLIK (TANPA LOGIN)
|--------------------------------------------------------------------------
|
*/
Route::get('/checkout/payment/qr/{token}', [PaymentController::class, 'showQr'])
    ->name('payment.qr');

Route::get('/pay/{token}', [PaymentController::class, 'showPayPage'])
    ->name('payment.pay-page');

Route::post('/pay/{token}/confirm', [PaymentController::class, 'confirm'])
    ->name('payment.confirm');


/*
|--------------------------------------------------------------------------
| ROUTE GUEST
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {

    // Halaman login 
    Route::get('/auth', [AuthController::class, 'showAuthPage'])
        ->name('auth.show');

    // Redirect /login lama ke /auth
    Route::get('/login', function () {
        return redirect()->route('auth.show');
    });

    // Proses login
    Route::post('/login', [AuthController::class, 'login'])
        ->name('login');

    // Proses register
    Route::post('/register', [AuthController::class, 'register'])
        ->name('register');

    // ===== LUPA PASSWORD DENGAN KODE VERIFIKASI =====

    // Form input email
    Route::get('/password/forgot', [AuthController::class, 'showForgotPasswordForm'])
        ->name('password.request');

    // Kirim kode ke email
    Route::post('/password/forgot', [AuthController::class, 'sendForgotCode'])
        ->name('password.email');

    // Form isi kode + password baru
    Route::get('/password/reset/code', [AuthController::class, 'showResetFormWithCode'])
        ->name('password.reset.code.form');

    // Proses simpan password baru
    Route::post('/password/reset/code', [AuthController::class, 'resetPasswordWithCode'])
        ->name('password.reset.code.update');
});


/*
|--------------------------------------------------------------------------
| ROUTE USER LOGIN (AUTH)
|--------------------------------------------------------------------------
| 
*/
Route::middleware('auth')->group(function () {

    // Profil
    Route::get('/profile', [UserManagementController::class, 'editProfile'])
        ->name('profile.edit');

    Route::put('/profile', [UserManagementController::class, 'updateProfile'])
        ->name('profile.update');

    // Halaman home user
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    // Halaman tentang
    Route::get('/tentang', [TentangKamiController::class, 'index'])
        ->name('tentang');

    // Daftar jasa 
    Route::get('/daftar-jasa', [ServiceRegistrationController::class, 'create'])
        ->name('daftar-jasa');

    // Simpan pendaftaran jasa
    Route::post('/daftar-jasa/store', [ServiceRegistrationController::class, 'store'])
        ->name('daftar-jasa.store');

    // Jasa saya
    Route::get('/jasa-saya', [HomePenjualController::class, 'index'])
        ->name('jasa-saya');

    Route::get('/penjual-home', [HomePenjualController::class, 'index']);

    // Daftar jasa
    Route::get('/jasa', [JasaController::class, 'index'])
        ->name('jasa.index');

    // KERANJANG
    Route::get('/cart', [CartController::class, 'index'])
        ->name('cart.index');

    // Tambah item ke keranjang
    Route::post('/cart/add', [CartController::class, 'store'])
        ->name('cart.add');

    // Checkout keranjang
    Route::post('/cart/checkout', [CartController::class, 'checkout'])
        ->name('cart.checkout');

    // PEMBAYARAN 
    Route::get('/checkout/payment', [PaymentController::class, 'selectMethod'])
        ->name('payment.select');

    Route::post('/checkout/payment/method', [PaymentController::class, 'processMethod'])
        ->name('payment.method');

    // API status pembayaran untuk auto-refresh
    Route::get('/payment/status/{token}', [PaymentController::class, 'status'])
        ->name('payment.status');

    // Pesanan saya (user)
    Route::get('/booking', [BookingController::class, 'index'])
        ->name('booking');

    // User membuat pesanan baru
    Route::post('/booking', [BookingController::class, 'store'])
        ->name('booking.store');

    // Update status pesanan 
    Route::put('/orders/{order}/status', [BookingController::class, 'updateStatus'])
        ->name('orders.update-status');

    // Menu Dompet
    Route::get('/wallet', [WalletController::class, 'index'])->name('wallet.index');
    Route::post('/wallet/withdraw', [WalletController::class, 'withdraw'])->name('wallet.withdraw');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});


/*
|--------------------------------------------------------------------------
| ROUTE ADMIN (WAJIB LOGIN + ROLE ADMIN)
|--------------------------------------------------------------------------
| 
*/
Route::middleware(['auth', 'hakakses:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard Admin
        Route::get('/dashboard', [AdminController::class, 'dashboard'])
            ->name('dashboard');

        // ================== ADMIN : DATA PENGGUNA ==================
        Route::resource('users', UserManagementController::class)
            ->except(['show', 'create', 'store']);

        // ================== ADMIN : DATA PENDAFTAR JASA ==================
        Route::get('/pendaftar-jasa', [ServiceRegistrationAdminController::class, 'index'])
            ->name('pendaftar-jasa');

        Route::post('/pendaftar-jasa/{id}/approve',
            [ServiceRegistrationController::class, 'approve']
        )->name('pendaftar-jasa.approve');

        Route::post('/pendaftar-jasa/{id}/reject',
            [ServiceRegistrationAdminController::class, 'reject']
        )->name('pendaftar-jasa.reject');

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

        Route::post('/orders/{id}/release', [OrderAdminController::class, 'releaseFunds'])
        ->name('orders.release');
    });

        
