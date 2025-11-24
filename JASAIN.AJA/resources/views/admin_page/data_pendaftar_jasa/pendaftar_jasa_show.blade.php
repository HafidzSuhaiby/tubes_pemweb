@extends('layouts.admin-layout')

@section('title', 'Tinjau Pendaftar Jasa')

@section('content')
<div class="bg-white shadow rounded-lg p-6">

    <h1 class="text-2xl font-semibold mb-6">Tinjau Pendaftar Jasa</h1>

    {{-- INFORMASI PRIBADI --}}
    <div class="mb-6">
        <h2 class="text-lg font-semibold mb-2">Informasi Pribadi</h2>
        <div class="space-y-1 text-gray-700">
            <p><strong>Nama:</strong> {{ $reg->user->name }}</p>
            <p><strong>Email:</strong> {{ $reg->user->email }}</p>
            <p><strong>Username:</strong> {{ $reg->user->username }}</p>
            <p><strong>Telepon:</strong> {{ $reg->user->telepon }}</p>
            <p><strong>Alamat:</strong> {{ $reg->user->alamat }}</p>
        </div>
    </div>

    {{-- INFORMASI JASA --}}
    <div class="mb-6">
        <h2 class="text-lg font-semibold mb-2">Informasi Jasa</h2>
        <div class="space-y-1 text-gray-700">
            <p><strong>Nama Jasa:</strong> {{ $reg->nama_jasa }}</p>
            <p><strong>Kategori:</strong> {{ $reg->kategori_label }}</p>
            <p><strong>Deskripsi:</strong> {{ $reg->deskripsi }}</p>
            <p><strong>Pengalaman:</strong> {{ $reg->pengalaman }} tahun</p>
            <p><strong>Harga Mulai:</strong> Rp {{ number_format($reg->harga_mulai,0,',','.') }}</p>
        </div>
    </div>

    {{-- LOKASI --}}
    <div class="mb-6">
        <h2 class="text-lg font-semibold mb-2">Lokasi dan Waktu</h2>
        <div class="space-y-1 text-gray-700">
            <p><strong>Kota:</strong> {{ $reg->kota }}</p>
            <p><strong>Area Layanan:</strong> {{ $reg->area_layanan }}</p>
            <p><strong>Hari Kerja:</strong> {{ $reg->hari_kerja }}</p>
            <p><strong>Jam Operasional:</strong> {{ $reg->jam_operasional }}</p>
        </div>
    </div>

    {{-- FILE VERIFIKASI --}}
    <div class="mb-6">
        <h2 class="text-lg font-semibold mb-2">Verifikasi Berkas</h2>

        {{-- KTP --}}
        @if($reg->ktp_path)
            <p><strong>KTP:</strong></p>
            <a href="{{ asset('storage/'.$reg->ktp_path) }}" 
            target="_blank" class="text-blue-500 underline">
                Lihat KTP
            </a>
        @else
            <p class="text-gray-500">Tidak ada KTP</p>
        @endif


        {{-- PORTOFOLIO --}}
        @php
            $portosRaw = $reg->portofolio_paths ?? [];
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
                $fotosRaw = $reg->foto_jasa_paths;
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

    {{-- TOMBOL SETUJUI / TOLAK --}}
    <div class="flex space-x-2 mt-6">
        <form action="{{ route('admin.pendaftar-jasa.approve', $reg->id) }}" method="POST">
            @csrf
            <button class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">
                ✔ Setujui
            </button>
        </form>

        <form action="{{ route('admin.pendaftar-jasa.reject', $reg->id) }}" method="POST">
            @csrf
            <button class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                ✖ Tolak
            </button>
        </form>

        <a href="{{ route('admin.pendaftar-jasa') }}"
           class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400">
           ← Kembali
        </a>
    </div>

</div>
@endsection
