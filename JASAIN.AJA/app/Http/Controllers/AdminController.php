<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ServiceRegistration;   // ← WAJIB ADA! IMPORT MODEL
// use App\Models\Order;              // ← JANGAN DIPAKAI KALAU BELUM ADA

class AdminController extends Controller
{
    public function dashboard()
    {
        // Statistik dasar
        $userCount = User::count();
        $serviceCount = ServiceRegistration::where('status', 'approved')->count();
        $orderCount = 0; // BELUM ADA ORDER, jadi 0 dulu
        $registrantCount = ServiceRegistration::count();    // kalau punya tabel report, nanti diganti

        // 5 pendaftar jasa terbaru
        $registrations = ServiceRegistration::with('user')
                        ->latest()
                        ->take(5)
                        ->get();

        // Belum ada tabel order → kosong dulu
        $orders = collect([]);

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
