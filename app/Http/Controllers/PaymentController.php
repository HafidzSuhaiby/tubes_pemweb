<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // Halaman pilih metode pembayaran (dropdown)
    public function selectMethod()
    {
        $token = session('checkout_token');
        $total = session('checkout_total', 0);

        if (!$token) {
            return redirect()->route('cart.index')
                ->with('error', 'Tidak ada transaksi yang akan dibayar.');
        }

        return view('payment.select', compact('token', 'total'));
    }

    // Proses pilihan metode (Dana / GoPay / OVO / Cash)
    public function processMethod(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:dana,gopay,ovo,cash',
        ]);

        $token = session('checkout_token');
        $total = session('checkout_total', 0);

        if (!$token) {
            return redirect()->route('cart.index')
                ->with('error', 'Sesi checkout sudah habis, silakan ulangi.');
        }

        $method = $request->payment_method;

        // Jika CASH: langsung jadi pesanan, tanpa QR
        if ($method === 'cash') {
            Order::where('payment_token', $token)->update([
                'payment_method' => 'cash',
                'payment_status' => 'unpaid',  // bisa juga 'cod' kalau mau
            ]);

            // bersihkan session checkout
            session()->forget(['checkout_token', 'checkout_total']);

            return redirect()->route('booking')
                ->with('success', 'Pesanan berhasil dibuat dengan metode Cash. Silakan bayar langsung ke penyedia.');
        }

        // Selain cash → e-wallet: update status & lanjut ke QR
        Order::where('payment_token', $token)->update([
            'payment_method' => $method,
            'payment_status' => 'waiting', // menunggu pembayaran
        ]);

        return redirect()->route('payment.qr', $token);
    }

    // Halaman QR di laptop
    public function showQr(string $token)
    {
        $orders = Order::with('service')
            ->where('payment_token', $token)
            ->get();

        if ($orders->isEmpty()) {
            abort(404);
        }

        $total  = $orders->sum(fn ($o) => $o->service->harga_mulai ?? 0);
        $method = $orders->first()->payment_method ?? '-';

        // URL yang akan dibuka saat QR discan
        // route(..., false) = hanya path "/pay/xxxx"
        // config('app.url') = http://10.208.217.170:8000 (dari .env)
        $payUrl = config('app.url') . route('payment.pay-page', $token, false);

        return view('payment.qr', compact('token', 'total', 'method', 'payUrl'));
    }

    // Halaman di HP setelah scan QR
    public function showPayPage(string $token)
    {
        $orders = Order::with('service')
            ->where('payment_token', $token)
            ->get();

        if ($orders->isEmpty()) {
            abort(404);
        }

        $total = $orders->sum(function ($o) {
            return $o->service->harga_mulai ?? 0;
        });

        return view('payment.pay-page', compact('token', 'total'));
    }

    // Tombol "Bayar Sekarang" di HP → anggap berhasil
    public function confirm(string $token)
    {
        // 1. Ambil data order sekaligus dengan data Service dan User (Penyedia)
        // Kita gunakan 'with' agar lebih efisien
        $order = Order::with('service.user')
                    ->where('payment_token', $token)
                    ->first(); 

        if (!$order) {
            abort(404);
        }

        // 2. Update status pembayaran (Logika asli tetap dipertahankan)
        Order::where('payment_token', $token)->update([
            'payment_status' => 'paid',
            'status'         => 'diterima',
        ]);
        
        // 3. Ambil nomor telepon dari User penyedia jasa
        // Alurnya: Order -> Service -> User -> Telepon
        // Kita pakai '?? null' untuk jaga-jaga jika datanya kosong
        $nomorWaPenyedia = $order->service->user->telepon ?? null;

        // 4. Kirim variabel $nomorWaPenyedia ke View
        return view('payment.paid-success', compact('nomorWaPenyedia'));
    }

    // Dipanggil oleh halaman QR (laptop) untuk auto-refresh status
    public function status(string $token)
    {
        $order = Order::where('payment_token', $token)->firstOrFail();

        return response()->json([
            'payment_status' => $order->payment_status,
        ]);
    }
}
