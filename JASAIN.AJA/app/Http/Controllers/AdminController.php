<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
// kalau belum punya model lain, sementara hapus saja Service, Order, Report
// use App\Models\Service;
// use App\Models\Order;
// use App\Models\Report;

class AdminController extends Controller
{
    public function dashboard()
    {
        // contoh paling simpel dulu: hanya hitung user
        $userCount = User::count();

        // nanti kalau sudah ada model layanan/jasa, pesanan, laporan bisa ditambah di sini
        // $serviceCount = Service::count();
        // $orderCount   = Order::count();
        // $reportCount  = Report::count();

        return view('admin_page.dashboard', compact('userCount'));
    }
}
