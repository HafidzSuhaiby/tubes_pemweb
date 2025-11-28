<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\ServiceRegistration;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Halaman keranjang
    public function index()
    {
        $carts = Cart::with(['service', 'provider'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('cart.index', compact('carts'));
    }

    // Tambah ke keranjang (dari modal booking)
    public function store(Request $request)
    {
        $request->validate([
            'service_id'   => 'required|exists:service_registrations,id',
            'booking_date' => 'required|date',
            'booking_time' => 'required',
            'alamat'       => 'required|string',
            'catatan'      => 'nullable|string',
        ]);

        $service = ServiceRegistration::findOrFail($request->service_id);

        Cart::create([
            'user_id'      => auth()->id(),
            'service_id'   => $service->id,
            'provider_id'  => $service->user_id,
            'booking_date' => $request->booking_date,
            'booking_time' => $request->booking_time,
            'alamat'       => $request->alamat,
            'catatan'      => $request->catatan,
        ]);

        return redirect()
            ->route('cart.index')
            ->with('success', 'Jasa berhasil dimasukkan ke keranjang.');
    }

    // Checkout: pindahkan dari keranjang → order
    public function checkout(Request $request)
    {
        $cartIds = $request->cart_ids;

        if (!$cartIds) {
            return back()->with('error', 'Silakan pilih minimal satu jasa.');
        }

        $carts = Cart::whereIn('id', $cartIds)
            ->where('user_id', auth()->id())
            ->get();

        foreach ($carts as $item) {
            Order::create([
                'user_id'      => $item->user_id,
                'service_id'   => $item->service_id,
                'provider_id'  => $item->provider_id,
                'booking_date' => $item->booking_date,
                'booking_time' => $item->booking_time,
                'alamat'       => $item->alamat,
                'catatan'      => $item->catatan,
                'status'       => 'pending',
            ]);
        }

        Cart::whereIn('id', $cartIds)->delete();

        return redirect()->route('booking')
            ->with('success', 'Checkout berhasil!');
    }
}
