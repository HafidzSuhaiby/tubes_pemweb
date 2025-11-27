<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ServiceRegistration;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // pastikan user login kalau membuat pesanan
    public function __construct()
    {
        $this->middleware('auth');
    }

    // halaman "Pesanan Saya" untuk user
    public function index()
    {
        $orders = Order::with(['service', 'provider'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('booking', compact('orders'));
    }

    // simpan pesanan baru
    public function store(Request $request)
    {
        // VALIDASI INPUT
        $request->validate([
            'service_id'      => 'required|exists:service_registrations,id',
            'booking_date'    => 'required|date',
            'booking_time'    => 'required',
            'alamat'          => 'required|string',
            'catatan'         => 'nullable|string',
        ]);

        // AMBIL DATA JASA
        $service = ServiceRegistration::findOrFail($request->service_id);

        // SIMPAN PESANAN KE DATABASE
        Order::create([
            'user_id'       => auth()->id(),        // user yang memesan
            'service_id'    => $service->id,        // id jasa
            'provider_id'   => $service->user_id,   // pemilik jasa (penyedia)
            'booking_date'  => $request->booking_date,
            'booking_time'  => $request->booking_time,
            'alamat'        => $request->alamat,
            'catatan'       => $request->catatan,
            'status'        => Order::STATUS_PENDING,  // default: pending
        ]);

        // REDIRECT KEMBALI
        return redirect()
            ->route('jasa.index')
            ->with('success', 'Pesanan berhasil dibuat! Menunggu konfirmasi penyedia jasa.');
    }

    // update status pesanan (dipakai penyedia & admin)
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,diterima,diproses,selesai,dibatalkan',
        ]);

        $order->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }
}
