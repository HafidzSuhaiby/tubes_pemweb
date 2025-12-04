<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ServiceRegistration;
use Illuminate\Http\Request;

class HomePenjualController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Ambil satu jasa utama penyedia (kalau kamu hanya izinkan 1 jasa per penyedia)
        $registration = ServiceRegistration::where('user_id', $user->id)->first();

        // Ambil semua pesanan yang masuk ke penyedia ini
        $orders = Order::with(['user', 'service'])
            ->where('provider_id', $user->id)   // ⬅ kuncinya di sini
            ->latest()
            ->get();

        return view('jasa-saya', compact('registration', 'orders'));
    }
}
