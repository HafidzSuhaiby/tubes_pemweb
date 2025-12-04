<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
// TAMBAHAN BARU: Import DB dan WalletTransaction
use Illuminate\Support\Facades\DB;
use App\Models\WalletTransaction; 

class OrderAdminController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'provider', 'service'])
            ->latest()
            ->paginate(20);

        return view('admin_page.data_pesanan.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'provider', 'service']);
        return view('admin_page.data_pesanan.show', compact('order'));
    }

    // ========== TAMBAHAN BARU DI SINI ==========
    public function releaseFunds($id)
    {
        // 1. Cari Order
        $order = Order::with('service.user')->findOrFail($id); // Tidak pakai \App\Models lagi karena sudah di-use di atas

        // 2. Validasi
        if ($order->status !== 'selesai') {
            return back()->with('error', 'Dana hanya bisa dicairkan jika status pesanan sudah SELESAI.');
        }

        if ($order->is_funds_released) {
            return back()->with('error', 'Dana untuk pesanan ini sudah pernah dicairkan.');
        }

        // 3. Proses Transaksi (Pakai DB Transaction agar aman)
        // Kita gunakan try-catch agar kalau error, databse tidak berantakan
        try {
            DB::transaction(function () use ($order) {
                // Ambil harga dari service
                $amount = $order->service->harga_mulai; 
                $provider = $order->provider; // User penyedia jasa

                // A. Tambah Saldo Penyedia
                $provider->saldo += $amount;
                $provider->save();

                // B. Catat Riwayat Transaksi
                WalletTransaction::create([
                    'user_id'     => $provider->id,
                    'type'        => 'credit', // credit = uang masuk
                    'amount'      => $amount,
                    'description' => 'Pencairan dana pesanan #' . $order->id,
                    'order_id'    => $order->id,
                ]);

                // C. Tandai Order sudah cair
                $order->is_funds_released = true;
                $order->save();
            });

            return back()->with('success', 'Dana berhasil dicairkan ke dompet penyedia jasa.');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat mencairkan dana: ' . $e->getMessage());
        }
    }
}