@extends('layouts.admin-layout')
@section('title', 'Dashboard')

@section('content')
<div class="h-auto font-fredoka">

    {{-- STATS CARDS --}}
    <div class="grid grid-cols-4 gap-4">
        {{-- Card 1: Users --}}
        <div class="grid grid-cols-4 gap-1 w-auto p-4 text-white bg-blue-500 shadow-sm rounded">
            <div class="grid grid-cols-1 col-span-3">
                <label class="text-md font-light">Total Pengguna</label>
                <span class="text-2xl font-medium">{{ $userCount }}</span>
            </div>
            <div class="text-3xl self-center">
                <i class="fa-regular fa-user" aria-hidden="true"></i>
            </div>
        </div>

        {{-- Card 2: Total Jasa --}}
        <div class="grid grid-cols-4 gap-1 w-auto p-4 text-white bg-red-500 shadow-sm rounded">
            <div class="grid grid-cols-1 col-span-3">
                <label class="text-md font-light">Total Jasa</label>
                <span class="text-2xl font-medium">{{ $serviceCount }}</span>
            </div>
            <div class="text-3xl self-center">
                <i class="fa-solid fa-briefcase" aria-hidden="true"></i>
            </div>
        </div>

        {{-- Card 3: Total Pesanan --}}
        <div class="grid grid-cols-4 gap-1 w-auto p-4 text-white bg-green-500 shadow-sm rounded">
            <div class="grid grid-cols-1 col-span-3">
                <label class="text-md font-light">Total Pesanan</label>
                <span class="text-2xl font-medium">{{ $orderCount }}</span>
            </div>
            <div class="text-3xl self-center">
                <i class="fa-solid fa-cart-shopping" aria-hidden="true"></i>
            </div>
        </div>

        {{-- Card 4: Total Pendaftar --}}
        <div class="grid grid-cols-4 gap-1 w-auto p-4 text-white bg-yellow-500 shadow-sm rounded">
            <div class="grid grid-cols-1 col-span-3">
                <label class="text-md font-light">Total Pendaftar</label>
                <span class="text-2xl font-medium">{{ $registrantCount }}</span>
            </div>
            <div class="text-3xl self-center">
                <i class="fa-solid fa-user-check" aria-hidden="true"></i>
            </div>
        </div>
    </div>

    {{-- TABLES --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">

        {{-- TABLE 1: PENDAFTAR JASA --}}
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-semibold text-gray-800">Pendaftar Jasa</h2>
                <a href="{{ route('admin.pendaftar-jasa') }}" 
                   class="text-md text-blue-600 hover:text-blue-800 hover:underline">
                    Lihat Semua
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-gray-400 border-b border-gray-100 text-xs uppercase tracking-wider">
                            <th class="py-3 font-semibold">Nama</th>
                            <th class="py-3 font-semibold">Jasa</th>
                            <th class="py-3 font-semibold">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-md text-gray-600">
                        @forelse ($registrations as $reg)
                            <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                                <td class="py-3 font-medium text-gray-800">
                                    {{ $reg->user->name }}
                                </td>
                                <td class="py-3">{{ $reg->nama_jasa }}</td>
                                <td class="py-3">
                                    @php
                                        $statusColor = [
                                            'pending'  => 'bg-yellow-100 text-yellow-700',
                                            'approved' => 'bg-green-100 text-green-700',
                                            'rejected' => 'bg-red-100 text-red-700',
                                        ];
                                    @endphp
                                    <span class="px-2 py-1 text-xs rounded-full font-semibold {{ $statusColor[$reg->status] ?? 'bg-gray-100 text-gray-700' }}">
                                        {{ ucfirst($reg->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="text-center py-4 text-sm text-gray-500">Belum ada data</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- TABLE 2: RIWAYAT PESANAN (SEDANG BERJALAN) --}}
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800">Riwayat Pesanan</h2>
                   
                </div>
                <a href="{{ route('admin.orders.index') }}" 
                   class="text-md text-blue-600 hover:text-blue-800 hover:underline">
                    Lihat Semua
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-gray-400 border-b border-gray-100 text-xs uppercase tracking-wider">
                            <th class="py-3 font-semibold">Pemesan</th>
                            <th class="py-3 font-semibold">Jasa</th>
                            <th class="py-3 font-semibold">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-md text-gray-600">
                        @forelse ($orders as $order)
                            @php
                                $statusBadge = match($order->status) {
                                    'pending'    => 'bg-gray-100 text-gray-700',
                                    'diterima'   => 'bg-blue-100 text-blue-700',
                                    'diproses'   => 'bg-yellow-100 text-yellow-800',
                                    'selesai'    => 'bg-green-100 text-green-700',
                                    'dibatalkan' => 'bg-red-100 text-red-700',
                                    default      => 'bg-gray-100 text-gray-700',
                                };
                            @endphp
                            <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                                <td class="py-3 font-medium text-gray-800">
                                    {{ $order->user->name }}
                                </td>
                                <td class="py-3">
                                    {{ $order->service->nama_jasa }}
                                </td>
                                <td class="py-3">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusBadge }}">
                                        {{ $order->status_label ?? ucfirst($order->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="text-center py-4 text-sm text-gray-500">
                                Belum ada pesanan yang sedang berjalan
                            </td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection
