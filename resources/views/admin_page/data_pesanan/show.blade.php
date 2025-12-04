@extends('layouts.admin-layout')

@section('title', 'Detail Pesanan #' . $order->id)

@section('content')
<div class="max-w-4xl mx-auto py-6">

    {{-- Tombol Kembali --}}
    <div class="mb-4">
        <a href="{{ route('admin.orders.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-semibold inline-flex items-center gap-2">
            <i class="fas fa-arrow-left"></i> Kembali ke Data Pesanan
        </a>
    </div>

    {{-- KARTU UTAMA: DETAIL PESANAN --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden mb-8">
        
        {{-- Header --}}
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50">
            <h1 class="text-xl font-semibold text-gray-800">Detail Pesanan #{{ $order->id }}</h1>
            
            {{-- Badge Status --}}
            @php
                $colors = [
                    'pending' => 'bg-gray-200 text-gray-700',
                    'diterima' => 'bg-blue-100 text-blue-700',
                    'diproses' => 'bg-yellow-100 text-yellow-800',
                    'selesai' => 'bg-green-100 text-green-700',
                    'dibatalkan' => 'bg-red-100 text-red-700',
                ];
                $colorClass = $colors[$order->status] ?? 'bg-gray-100 text-gray-700';
            @endphp
            <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide {{ $colorClass }}">
                {{ $order->status }}
            </span>
        </div>

        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-8">
            
            {{-- Info Jasa --}}
            <div>
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-4 border-b pb-2">Informasi Jasa</h3>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-500">Nama Jasa</p>
                        <p class="font-bold text-gray-800 text-lg">{{ $order->service->nama_jasa ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Kategori</p>
                        <p class="font-medium text-gray-700">{{ $order->service->kategori ?? '-' }}</p>
                    </div>
                    <div class="bg-blue-50 p-3 rounded-lg border border-blue-100">
                        <p class="text-sm text-blue-500 mb-1">Jadwal Booking</p>
                        <div class="flex items-center gap-2 text-blue-800 font-semibold">
                            <i class="far fa-calendar"></i>
                            <span>{{ \Carbon\Carbon::parse($order->booking_date)->format('d F Y') }}</span>
                            <span class="mx-1">|</span>
                            <i class="far fa-clock"></i>
                            <span>{{ $order->booking_time }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Info Pembayaran --}}
            <div>
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-4 border-b pb-2">Informasi Pembayaran</h3>
                <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                    <div class="flex justify-between items-center mb-3">
                        <span class="text-sm text-gray-500">Total Harga</span>
                        <span class="font-bold text-green-600 text-xl">
                            Rp {{ number_format($order->service->harga_mulai ?? 0, 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm text-gray-500">Metode</span>
                        <span class="font-medium text-gray-700 uppercase bg-white px-2 py-1 rounded border text-xs">
                            {{ $order->payment_method ?? 'Cash' }}
                        </span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">Status Bayar</span>
                        <span class="font-bold text-xs uppercase px-2 py-1 rounded {{ $order->payment_status == 'paid' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $order->payment_status ?? 'Unpaid' }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Info Pemesan & Penyedia (Baris Baru) --}}
            <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-gray-100">
                
                {{-- Pemesan --}}
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center text-gray-500 flex-shrink-0">
                        <i class="fas fa-user"></i>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-gray-800">Pemesan</h4>
                        <p class="text-gray-600">{{ $order->user->name ?? 'User Terhapus' }}</p>
                        <p class="text-xs text-gray-400">{{ $order->user->email ?? '-' }}</p>
                        @if($order->user->telepon)
                            <p class="text-xs text-green-600 mt-1"><i class="fab fa-whatsapp"></i> {{ $order->user->telepon }}</p>
                        @endif
                    </div>
                </div>

                {{-- Penyedia --}}
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-store"></i>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-gray-800">Penyedia Jasa</h4>
                        <p class="text-gray-600">{{ $order->provider->name ?? 'Provider Terhapus' }}</p>
                        <p class="text-xs text-gray-400">{{ $order->provider->email ?? '-' }}</p>
                    </div>
                </div>
            </div> {{-- End Grid Pemesan/Penyedia --}}

        </div> {{-- End Main Grid --}}
    </div> {{-- End Kartu Utama --}}


    {{-- KARTU KEDUA: PANEL AKSI ADMIN (RELEASE DANA) --}}
    {{-- Ini dipisah agar rapi --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
            <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wide">Aksi Admin (Rekening Bersama)</h3>
        </div>
        
        <div class="p-6">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <p class="text-gray-600 mb-1 font-medium">Status Pencairan Dana:</p>
                    @if($order->is_funds_released)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">
                            <i class="fas fa-check-circle mr-2"></i> SUDAH DICAIRKAN
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-500">
                            <i class="fas fa-clock mr-2"></i> BELUM DICAIRKAN
                        </span>
                    @endif
                </div>

                <div>
                    {{-- Tombol hanya muncul jika status pesanan SELESAI dan Dana BELUM cair --}}
                    @if($order->status === 'selesai' && !$order->is_funds_released)
                        <form action="{{ route('admin.orders.release', $order->id) }}" method="POST" onsubmit="return confirm('Yakin ingin mencairkan dana ke penyedia jasa? Tindakan ini tidak bisa dibatalkan.');">
                            @csrf
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg shadow-lg transition transform hover:-translate-y-1 w-full md:w-auto">
                                <i class="fas fa-wallet mr-2"></i> Cairkan Dana Sekarang
                            </button>
                        </form>
                    @elseif($order->status !== 'selesai')
                        <button disabled class="bg-gray-200 text-gray-400 font-bold py-2 px-6 rounded-lg cursor-not-allowed w-full md:w-auto">
                            Menunggu Pesanan Selesai
                        </button>
                    @endif
                </div>
            </div>
            
            <div class="mt-4 p-4 bg-blue-50 text-blue-800 text-sm rounded-lg border border-blue-100">
                <i class="fas fa-info-circle mr-1"></i> 
                <strong>Info:</strong> Dana sebesar <strong>Rp {{ number_format($order->service->harga_mulai, 0, ',', '.') }}</strong> akan ditransfer dari Rekening Bersama ke Saldo Dompet Penyedia Jasa ({{ $order->provider->name }}).
            </div>
        </div>
    </div>

</div>
@endsection