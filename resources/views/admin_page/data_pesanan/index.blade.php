@extends('layouts.admin-layout')

@section('title', 'Data Pesanan')

@section('content')
<div class="max-w-6xl mx-auto py-6">

    {{-- CARD WRAPPER --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

        {{-- HEADER DI DALAM CARD --}}
        <div class="px-6 py-4 border-b border-gray-100">
            <h1 class="text-xl font-semibold text-gray-800">Data Pesanan</h1>
        </div>

        {{-- KONTEN TABEL --}}
        @if($orders->isEmpty())
            <div class="p-8 text-center text-gray-500 text-sm">
                Belum ada pesanan yang tercatat.
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-gray-700">
                    <thead class="bg-gray-50 text-xs font-semibold uppercase tracking-wide text-gray-500">
                        <tr>
                            <th class="px-6 py-3 text-left">#</th>
                            <th class="px-6 py-3 text-left">Pemesan</th>
                            <th class="px-6 py-3 text-left">Penyedia</th>
                            <th class="px-6 py-3 text-left">Jasa</th>
                            <th class="px-6 py-3 text-left">Jadwal</th>
                            <th class="px-6 py-3 text-left">Status</th>
                            <th class="px-6 py-3 text-left">Dibuat</th>
                            <th class="px-6 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $index => $order)
                        @php
                            $statusColors = [
                                'pending'    => 'bg-gray-100 text-gray-700',
                                'diterima'   => 'bg-blue-100 text-blue-700',
                                'diproses'   => 'bg-yellow-100 text-yellow-800',
                                'selesai'    => 'bg-green-100 text-green-700',
                                'dibatalkan' => 'bg-red-100 text-red-700',
                            ];
                        @endphp

                        <tr class="border-t border-gray-100">
                            <td class="px-6 py-4">{{ $orders->firstItem() + $index }}</td>

                            {{-- Pemesan --}}
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-800">{{ $order->user->name }}</div>
                                <div class="text-xs text-gray-500">{{ $order->user->email }}</div>
                            </td>

                            {{-- Penyedia --}}
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-800">{{ $order->provider->name }}</div>
                                <div class="text-xs text-gray-500">{{ $order->provider->email }}</div>
                            </td>

                            {{-- Nama jasa --}}
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-800">{{ $order->service->nama_jasa }}</div>
                                <div class="text-xs text-gray-500">{{ $order->service->kategori_label }}</div>
                            </td>

                            {{-- Jadwal --}}
                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($order->booking_date)->format('d M Y') }}<br>
                                <span class="text-xs text-gray-500">{{ $order->booking_time }}</span>
                            </td>

                            {{-- Status --}}
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusColors[$order->status] }}">
                                    {{ $order->status_label }}
                                </span>
                            </td>

                            {{-- Waktu dibuat --}}
                            <td class="px-6 py-4">
                                {{ $order->created_at->format('d M Y') }}<br>
                                <span class="text-xs text-gray-500">{{ $order->created_at->format('H:i') }}</span>
                            </td>

                            {{-- Detail --}}
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.orders.show', $order) }}"
                                   class="inline-flex items-center px-3 py-1.5 rounded-full 
                                          text-xs font-semibold bg-blue-500 text-white
                                          hover:bg-blue-600 transition">
                                    <i class="fa-solid fa-eye fa-xs mr-1"></i>
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $orders->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
