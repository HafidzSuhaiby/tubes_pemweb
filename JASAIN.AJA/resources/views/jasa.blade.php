@extends('layouts.main')

@section('title', 'Jasain Aja - Solusi Semua Jasa')

@push('styles')
    @vite('resources/css/jasa.css')
@endpush

@push('scripts')
    @vite('resources/js/jasa.js')
@endpush


{{-- ===============================
    BANNER SLIDER
================================ --}}
@section('banner')

<div class="banner-full">
    <div class="swiper mySwiper">

        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="{{ asset('images/banner1.png') }}" alt="">
            </div>

            <div class="swiper-slide">
                <img src="{{ asset('images/banner2.png') }}" alt="">
            </div>

            <div class="swiper-slide">
                <img src="{{ asset('images/banner3.png') }}" alt="">
            </div>
        </div>

        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>

    </div>
</div>

@endsection

{{-- ===============================
    KONTEN
================================ --}}
@section('content')

<div class="container py-5">

    <div class="text-center mb-5">
        <h1 class="fw-bold text-dark">Pilih Jasa Sesuai</h1>
        <p class="text-secondary fs-5">Kebutuhan Anda...</p>
    </div>

    {{-- ================= FILTER ================= --}}
    <div class="d-flex flex-wrap justify-content-center gap-3 mb-4">

        <select id="filterKategori" class="form-select w-auto">
            <option value="">Semua Kategori</option>
            @foreach ($kategoriList as $kategori)
                <option value="{{ $kategori }}">{{ $kategori }}</option>
            @endforeach
        </select>

        <select id="filterArea" class="form-select w-auto">
            <option value="">Semua Area</option>
            @foreach ($areaList as $area)
                <option value="{{ $area }}">{{ $area }}</option>
            @endforeach
        </select>

        <button onclick="applyFilter()" class="btn btn-dark px-4">OK</button>

    </div>

    {{-- ================= GRID JASA ================= --}}
    @if ($services->count() > 0)

        <div class="card-grid-wrapper">
            <div class="card-grid">

                @foreach ($services as $service)

                    @php
                        // --- Ambil foto pertama ---
                        $raw = $service->foto_jasa_paths;
                        $foto = null;

                        if (is_array($raw)) $foto = $raw[0] ?? null;
                        elseif (is_string($raw)) {
                            $decode = json_decode($raw, true);
                            if (json_last_error() === JSON_ERROR_NONE && is_array($decode)) {
                                $foto = $decode[0] ?? null;
                            } else {
                                $foto = $raw;
                            }
                        }

                        $fotoUrl = $foto ? asset("storage/$foto") : asset('images/jasa1.png');
                    @endphp

                    <div class="card-item card shadow-sm border-0 h-100"
                         data-kategori="{{ $service->kategori_label }}"
                         data-lokasi="{{ $service->kota ?? '' }}"
                         style="background:#0f1b33; color:white;">

                        {{-- FOTO JASA --}}
                        <img src="{{ $fotoUrl }}" class="card-img-top" alt="Foto Jasa">

                        <div class="card-body d-flex flex-column">

                            <h5 class="card-title fw-bold mb-1">
                                {{ $service->nama_jasa }}
                            </h5>

                            <p class="card-text text-light mb-3" style="font-size: 0.9rem;">
                                {{ \Illuminate\Support\Str::limit($service->deskripsi, 80) }}
                            </p>

                            <p class="mb-1">
                                <strong>Lokasi:</strong> {{ $service->kota ?? '-' }}
                            </p>

                            <p class="mb-1">
                                <strong>Operasional:</strong>
                                {{ $service->jam_operasional ?? '-' }}
                            </p>

                            <p class="mb-3">
                                <strong>Harga Mulai:</strong>
                                @if($service->harga_mulai)
                                    Rp {{ number_format($service->harga_mulai, 0, ',', '.') }}
                                @else
                                    -
                                @endif
                            </p>

                            <button class="btn btn-primary w-100 mt-auto">
                                Booking Sekarang
                            </button>

                        </div>
                    </div>

                @endforeach

            </div>
        </div>

    {{-- ================= NO DATA ================= --}}
    @else
        <div class="d-flex justify-content-center align-items-center w-100" style="height: 40vh;">
            <p class="text-muted fs-5 m-0">Belum ada jasa yang tampil saat ini.</p>
        </div>
    @endif
</div>

@endsection
