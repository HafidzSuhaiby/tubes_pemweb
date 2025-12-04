@extends('layouts.admin-layout')

@section('title', 'Daftar Jasa Disetujui')

@section('content')
<div class="bg-white shadow rounded-lg p-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-semibold text-gray-800 font-fredoka">
            Daftar Jasa Disetujui
        </h1>

        {{-- nanti kalau mau tambah filter / export bisa taruh di sini --}}
        {{-- <a href="#" class="text-sm text-blue-600 hover:underline">Export</a> --}}
    </div>

    {{-- Flash message --}}
    @if (session('success'))
        <div class="mb-4 p-3 rounded bg-green-100 text-green-800 text-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- TABLE --}}
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    <th class="px-4 py-3 text-left">#</th>
                    <th class="px-4 py-3 text-left">Penyedia</th>
                    <th class="px-4 py-3 text-left">Nama Jasa</th>
                    <th class="px-4 py-3 text-left">Kategori</th>
                    <th class="px-4 py-3 text-left">Kota</th>
                    <th class="px-4 py-3 text-left">Harga Mulai</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-left">Tampil</th>
                    <th class="px-4 py-3 text-left">Aksi</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-100">
                @forelse ($services as $service)
                    <tr class="hover:bg-gray-50">
                        {{-- No --}}
                        <td class="px-4 py-3">
                            {{ $loop->iteration + ($services->currentPage() - 1) * $services->perPage() }}
                        </td>

                        {{-- Penyedia --}}
                        <td class="px-4 py-3 font-medium text-gray-800">
                            {{ $service->user->name ?? '-' }}
                        </td>

                        {{-- Nama Jasa --}}
                        <td class="px-4 py-3">
                            {{ $service->nama_jasa }}
                        </td>

                        {{-- Kategori (pakai accessor kategori_label di model) --}}
                        <td class="px-4 py-3">
                            {{ $service->kategori_label }}
                        </td>

                        {{-- Kota --}}
                        <td class="px-4 py-3">
                            {{ $service->kota ?? '-' }}
                        </td>

                        {{-- Harga Mulai --}}
                        <td class="px-4 py-3">
                            @if($service->harga_mulai)
                                Rp {{ number_format($service->harga_mulai, 0, ',', '.') }}
                            @else
                                -
                            @endif
                        </td>
                        {{-- Status selalu approved, tapi tetap kasih badge --}}
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                Disetujui
                            </span>
                        </td>

                        {{-- Tampil di Halaman? (is_active) --}}
                        <td class="px-4 py-3">
                            @if($service->is_active)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                    Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-200 text-gray-700">
                                    Disembunyikan
                                </span>
                            @endif
                        </td>

                        {{-- Aksi --}}
                        <td class="px-4 py-3">
                            <form action="{{ route('admin.data-jasa.toggle', $service->id) }}" method="POST" class="inline-block">
                                @csrf
                                <button type="submit"
                                    class="inline-flex items-center px-3 py-1 rounded text-xs font-medium
                                        {{ $service->is_active ? 'bg-red-500 hover:bg-red-600 text-white' : 'bg-green-500 hover:bg-green-600 text-white' }}">
                                    {{ $service->is_active ? 'Sembunyikan di Halaman' : 'Tampilkan di Halaman' }}
                                </button>
                            </form>
                        </td>


                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-4 py-4 text-center text-gray-500">
                            Belum ada jasa yang disetujui.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- PAGINATION --}}
    <div class="mt-4">
        {{ $services->links() }}
    </div>
</div>
@endsection
