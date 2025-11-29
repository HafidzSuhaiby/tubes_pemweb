<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\ServiceRegistration;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with(['service', 'provider'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('cart.index', compact('carts'));
    }

    // TAMBAH KE KERANJANG
    public function store(Request $request)
    {
        // VALIDASI
        $request->validate([
            'service_id'   => 'required|exists:service_registrations,id',
            'booking_date' => 'required|date',
            'booking_time' => 'required',
            'alamat'       => 'required|string',
            'catatan'      => 'nullable|string',
        ]);

        // AMBIL JASA UNTUK DAPAT PROVIDER
        $service = ServiceRegistration::findOrFail($request->service_id);

        Cart::create([
            'user_id'      => auth()->id(),
            'service_id'   => $service->id,
            'provider_id'  => $service->user_id,   // <- BUKAN DARI REQUEST
            'booking_date' => $request->booking_date,
            'booking_time' => $request->booking_time,
            'alamat'       => $request->alamat,
            'catatan'      => $request->catatan,
        ]);

        return redirect()->route('cart.index')
            ->with('success', 'Berhasil ditambahkan ke keranjang.');
    }

    // CHECKOUT
    public function checkout(Request $request)
    {
        $request->validate([
            'cart_ids'   => 'required|array',
            'cart_ids.*' => 'exists:carts,id',
        ]);

        $cartItems = Cart::with(['service'])
            ->where('user_id', auth()->id())
            ->whereIn('id', $request->cart_ids)
            ->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Tidak ada item yang dipilih.');
        }

        $token = Str::uuid();
        $total = 0;

        foreach ($cartItems as $item) {
            $service = $item->service;
            $harga   = $service->harga_mulai ?? 0;
            $total  += $harga;

            Order::create([
                'user_id'        => $item->user_id,
                'service_id'     => $item->service_id,
                'provider_id'    => $item->provider_id ?? ($service->user_id ?? null),
                'booking_date'   => $item->booking_date,
                'booking_time'   => $item->booking_time,
                'alamat'         => $item->alamat,
                'catatan'        => $item->catatan,
                'status'         => 'pending',
                'payment_status' => 'unpaid',
                'payment_method' => null,
                'payment_token'  => $token,
            ]);
        }

        Cart::whereIn('id', $request->cart_ids)->delete();

        session([
            'checkout_token' => $token,
            'checkout_total' => $total,
        ]);

        return redirect()->route('payment.select');
    }
}
