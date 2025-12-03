<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

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
}
