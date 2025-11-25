@extends('layouts.admin-layout')

@section('title', 'Detail Jasa')

@section('content')
<div class="bg-white shadow rounded-lg p-6">

    <h1 class="text-2xl font-semibold mb-6">Detail Jasa</h1>

    {{-- INFORMASI PRIBADI --}}
    <div class="mb-6">
        <h2 class="text-lg font-semibold mb-2">Informasi Penyedia</h2>
        <div class="space-y-1 text-gray-700">
            <p><strong>Nama:</strong> {{ $service->user->name ?? '-' }}</p>
            <p><strong>Email:</strong> {{ $service->user->email ?? '-' }}</p>
            <p><strong>Username:</strong> {{ $service->user->username ?? '-' }}</p>
            <p><strong>Telepon:</strong> {{ $service->user->telepon ?? '-' }}</p>
            <p><strong>Alamat:</strong> {{ $service->user->alamat ?? '-' }}</p>
        </div>
    </div>

    {{-- INFORMASI JASA --}}
    <div class="mb-6">
        <h2 class="text-lg font-semibold mb-2">Informasi Jasa</h2>
        <div class="space-y-1 text-gray-700">
            <p><strong>Nama Jasa:</strong> {{ $service->nama_jasa }}</p>
            <p><strong>Kategori:</strong> {{ $service->kategori_label }}</p>
            <p><strong>Deskripsi:</strong> {{ $service->deskripsi ?: '-' }}</p>
            <p><strong>Pengalaman:</strong> 
                {{ $service->pengalaman ? $service->pengalaman . ' tahun' : '-' }}
            </p>
            <p><strong>Harga Mulai:</strong> 
                @if($service->harga_mulai)
                    Rp {{ number_format($service->harga_mulai, 0, ',', '.') }}
                @else
                    -
                @endif
            </p>
        </div>
    </div>

    {{-- LOKASI --}}
    <div class="mb-6">
        <h2 class="text-lg font-semibold mb-2">Lokasi dan Waktu</h2>
        <div class="space-y-1 text-gray-700">
            <p><strong>Kota:</strong> {{ $service->kota ?? '-' }}</p>
            <p><strong>Area Layanan:</strong> {{ $service->area_layanan ?? '-' }}</p>
            <p><strong>Hari Kerja:</strong> {{ $service->hari_kerja ?? '-' }}</p>
            <p><strong>Jam Operasional:</strong> {{ $service->jam_operasional ?? '-' }}</p>
        </div>
    </div>

    {{-- FILE VERIFIKASI --}}
    <div class="mb-6">
        <h2 class="text-lg font-semibold mb-2">Verifikasi Berkas</h2>

        {{-- KTP --}}
        @if($service->ktp_path)
            <p><strong>KTP:</strong></p>
            <a href="{{ asset('storage/'.$service->ktp_path) }}" 
               target="_blank" class="text-blue-500 underline">
                Lihat KTP
            </a>
        @else
            <p class="text-gray-500">Tidak ada KTP</p>
        @endif

        {{-- PORTOFOLIO --}}
        @php
            $portosRaw = $service->portofolio_paths ?? [];
            $portos = [];

            if (is_array($portosRaw)) {
                $portos = $portosRaw;
            } elseif (is_string($portosRaw) && $portosRaw !== '') {
                $decoded = json_decode($portosRaw, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    $portos = $decoded;
                } else {
                    $portos = [$portosRaw];
                }
            }
        @endphp

        @if(!empty($portos))
            <p class="mt-4"><strong>Portofolio:</strong></p>
            <div class="flex space-x-3 mt-2">
                @foreach($portos as $porto)
                    <img src="{{ asset('storage/'.$porto) }}" 
                         class="w-24 h-24 object-cover rounded border">
                @endforeach
            </div>
        @else
            <p class="text-gray-500 mt-4">Tidak ada portofolio</p>
        @endif

        {{-- FOTO JASA --}}
        <div class="mt-3">
            <p><strong>Foto Jasa:</strong></p>

            @php
                $fotosRaw = $service->foto_jasa_paths;
                $fotos = [];

                if (is_array($fotosRaw)) {
                    $fotos = $fotosRaw;
                } elseif (is_string($fotosRaw) && $fotosRaw !== '') {
                    $decoded = json_decode($fotosRaw, true);
                    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                        $fotos = $decoded;
                    } else {
                        $fotos = [$fotosRaw];
                    }
                }
            @endphp

            @if(!empty($fotos))
                <div class="flex space-x-3 mt-2">
                    @foreach($fotos as $foto)
                        <img src="{{ asset('storage/'.$foto) }}"
                             class="w-24 h-24 object-cover rounded border">
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">Tidak ada foto jasa</p>
            @endif
        </div>
    </div>

    {{-- TOMBOL KEMBALI --}}
    <div class="mt-6">
        <a href="{{ route('admin.data-jasa.index') }}"
           class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400">
           ← Kembali ke Daftar Jasa
        </a>
    </div>

</div>
@endsection
