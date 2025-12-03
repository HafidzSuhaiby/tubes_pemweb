<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ServiceRegistration;
use App\Models\Order; // ← WAJIB: tambahkan model Order

class AdminController extends Controller
{
    public function dashboard()
    {
        // =============================
        //      STATISTIK DASHBOARD
        // =============================
        $userCount        = User::count();
        $serviceCount     = ServiceRegistration::where('status', 'approved')->count();
        $orderCount       = Order::count(); // total semua pesanan
        $registrantCount  = ServiceRegistration::count();


        // =======================================
        //   PENDAFTAR JASA TERBARU (LIMIT 5)
        // =======================================
        $registrations = ServiceRegistration::with('user')
                        ->latest()
                        ->take(5)
                        ->get();


        // ====================================================
        //   PESANAN YANG SEDANG BERJALAN (pending/diproses/dll)
        // ====================================================
        $orders = Order::with(['user', 'service'])
            ->whereIn('status', ['pending', 'diterima', 'diproses'])
            ->latest()
            ->take(5)
            ->get();


        // ====================================================
        //   KIRIM KE VIEW
        // ====================================================
        return view('admin_page.dashboard', compact(
            'userCount',
            'serviceCount',
            'orderCount',
            'registrantCount',
            'registrations',
            'orders',
        ));
    }
}
