<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\WalletTransaction;

class WalletController extends Controller
{
    // Halaman Dompet Saya
    public function index()
    {
        $user = Auth::user();
        
        // Ambil riwayat transaksi, urutkan dari yang terbaru
        $transactions = WalletTransaction::where('user_id', $user->id)
                            ->latest()
                            ->get();

        return view('wallet.index', compact('user', 'transactions'));
    }

    // Proses Tarik Tunai (Withdrawal)
    public function withdraw(Request $request)
    {
        $user = Auth::user();

        // 1. Validasi Input
        $request->validate([
            'amount' => 'required|numeric|min:10000', // Minimal tarik 10rb
            'bank_name' => 'required|string',
            'account_number' => 'required|string',
        ]);

        // 2. Cek apakah saldo cukup
        if ($user->saldo < $request->amount) {
            return back()->with('error', 'Saldo tidak mencukupi untuk melakukan penarikan.');
        }

        // 3. Proses Database (Pakai Transaction biar aman)
        try {
            DB::transaction(function () use ($user, $request) {
                // A. Kurangi Saldo User
                $user->saldo -= $request->amount;
                $user->save();

                // B. Catat di Riwayat Transaksi
                WalletTransaction::create([
                    'user_id' => $user->id,
                    'type' => 'debit', // debit = uang keluar
                    'amount' => $request->amount,
                    'description' => 'Penarikan dana ke ' . $request->bank_name . ' (' . $request->account_number . ')',
                ]);
            });

            return back()->with('success', 'Permintaan penarikan berhasil! Saldo Anda telah dikurangi.');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }
}