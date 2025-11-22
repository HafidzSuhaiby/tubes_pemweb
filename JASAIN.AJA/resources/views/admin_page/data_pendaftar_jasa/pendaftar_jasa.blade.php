@extends('layouts.admin-layout')

@section('title', 'Daftar Pendaftar Jasa')

@section('content')
<div class="bg-white shadow rounded-lg p-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-semibold text-gray-800 font-fredoka">
            Daftar Pendaftar Jasa
        </h1>
    </div>

    {{-- Flash message --}}
    @if (session('success'))
        <div class="mb-4 px-4 py-2 rounded-lg bg-green-100 text-green-700 text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 px-4 py-2 rounded-lg bg-red-100 text-red-700 text-sm">
            {{ session('error') }}
        </div>
    @endif

    {{-- Tabel --}}
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left font-medium text-gray-500">#</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-500">Pendaftar</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-500">Nama Jasa</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-500">Kategori</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-500">Lokasi</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-500">Status</th>
                    <th class="px-4 py-3 text-right font-medium text-gray-500">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100 bg-white">
                @forelse ($registrations as $index => $r)
                    <tr>
                        {{-- # --}}
                        <td class="px-4 py-3">
                            {{ $index + 1 }}
                        </td>

                        {{-- Pendaftar --}}
                        <td class="px-4 py-3">
                            <div class="font-medium text-gray-800">
                                {{ $r->user->name ?? '-' }}
                            </div>
                            <div class="text-gray-500 text-xs">
                                {{ $r->user->email ?? '-' }}
                            </div>
                        </td>

                        {{-- Nama Jasa --}}
                        <td class="px-4 py-3">
                            <div class="font-medium text-gray-800">
                                {{ $r->nama_jasa }}
                            </div>
                        </td>

                        {{-- Kategori --}}
                        <td class="px-4 py-3 text-gray-700">
                            {{ $r->kategori_label }}
                        </td>

                        {{-- Lokasi --}}
                        <td class="px-4 py-3 text-gray-700">
                            {{ $r->kota ?? '-' }}
                        </td>

                        {{-- Status --}}
                        <td class="px-4 py-3">
                            @if($r->status === 'pending')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                                    Sedang Ditinjau
                                </span>
                            @elseif($r->status === 'approved')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                    Disetujui
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                    Ditolak
                                </span>
                            @endif
                        </td>

                        {{-- Aksi --}}
                        <td class="px-4 py-3">
                            <div class="flex justify-end">
                                <a href="{{ route('admin.pendaftar-jasa.show', $r->id) }}"
                                   class="px-3 py-1 text-xs rounded-lg bg-blue-500 text-white hover:bg-blue-600 flex items-center space-x-1">
                                    <i class="fa-solid fa-eye fa-sm"></i>
                                    <span>Tinjau</span>
                                </a>
                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td class="px-4 py-4 text-center text-gray-500" colspan="7">
                            Belum ada pendaftar jasa.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
