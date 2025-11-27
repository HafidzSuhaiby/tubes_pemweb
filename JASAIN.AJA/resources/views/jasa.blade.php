@extends('layouts.main')

@section('title', 'Jasain Aja - Solusi Semua Jasa')

@push('styles')
    @vite('resources/css/jasa.css')
@endpush

{{-- kalau masih mau pakai file JS lama (misal untuk filter), biarkan ini --}}
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

                        if (is_array($raw)) {
                            $foto = $raw[0] ?? null;
                        } elseif (is_string($raw)) {
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

                            <button
                                type="button"
                                class="btn btn-primary w-100 mt-auto btn-booking"
                                data-bs-toggle="modal"
                                data-bs-target="#bookingModal"
                                data-id="{{ $service->id }}"
                                data-nama="{{ $service->nama_jasa }}"
                                data-kategori="{{ $service->kategori_label }}"
                                data-lokasi="{{ $service->kota ?? '-' }}"
                                data-jam="{{ $service->jam_operasional ?? '-' }}"
                                data-harga="{{ $service->harga_mulai ?? '' }}"
                                data-foto="{{ $fotoUrl }}"
                            >
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

{{-- MODAL BOOKING --}}
<div class="modal fade" id="bookingModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Booking Jasa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div class="row g-4">

          {{-- SIDEBAR INFO JASA --}}
          <div class="col-md-5">
            <div class="border rounded p-3 h-100" style="background:#0f1b33; color:white;">
              <img id="modalJasaFoto" src="" alt="" class="img-fluid rounded mb-3">

              <h5 id="modalJasaNama" class="fw-bold mb-2"></h5>
              <p class="mb-1"><strong>Kategori:</strong> <span id="modalJasaKategori"></span></p>
              <p class="mb-1"><strong>Lokasi:</strong> <span id="modalJasaLokasi"></span></p>
              <p class="mb-1"><strong>Operasional:</strong> <span id="modalJasaJam"></span></p>
              <p class="mb-1">
                <strong>Harga Mulai:</strong>
                <span id="modalJasaHarga"></span>
              </p>
            </div>
          </div>

          {{-- FORM BOOKING --}}
          <div class="col-md-7">
            @auth
            <form id="bookingForm" method="POST" action="{{ route('booking.store') }}">
              @csrf
              <input type="hidden" name="service_id" id="bookingServiceId">

              <div class="mb-3">
                <label for="booking_date" class="form-label">Tanggal Booking</label>
                <input type="date" class="form-control" name="booking_date" id="booking_date" required>
              </div>

              <div class="mb-3">
                <label for="booking_time" class="form-label">Jam Booking</label>
                <input type="time" class="form-control" name="booking_time" id="booking_time" required>
              </div>

              <div class="mb-3">
                <label for="alamat" class="form-label">Alamat Lengkap</label>
                <textarea class="form-control" name="alamat" id="alamat" rows="3" required></textarea>
              </div>

              <div class="mb-3">
                <label for="catatan" class="form-label">Catatan Tambahan (opsional)</label>
                <textarea class="form-control" name="catatan" id="catatan" rows="2"></textarea>
              </div>

              <div class="d-flex justify-content-between align-items-center">
                {{-- tombol pembayaran nanti diisi logic --}}
                <button type="button" class="btn btn-outline-secondary" disabled>
                  Pembayaran (coming soon)
                </button>

                <button type="submit" class="btn btn-primary">
                  Buat Pesanan
                </button>
              </div>
            </form>
            @else
              <p>Silakan <a href="{{ route('auth.show') }}">login</a> terlebih dahulu untuk melakukan booking.</p>
            @endauth
          </div>

        </div>
      </div>

    </div>
  </div>
</div>

@endsection

{{-- SCRIPT UNTUK ISI DATA MODAL + service_id --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.btn-booking');

    const serviceIdInput = document.getElementById('bookingServiceId');
    const jasaNamaEl     = document.getElementById('modalJasaNama');
    const jasaKategoriEl = document.getElementById('modalJasaKategori');
    const jasaLokasiEl   = document.getElementById('modalJasaLokasi');
    const jasaJamEl      = document.getElementById('modalJasaJam');
    const jasaHargaEl    = document.getElementById('modalJasaHarga');
    const jasaFotoEl     = document.getElementById('modalJasaFoto');

    buttons.forEach(btn => {
        btn.addEventListener('click', () => {
            const id       = btn.dataset.id;
            const nama     = btn.dataset.nama;
            const kategori = btn.dataset.kategori;
            const lokasi   = btn.dataset.lokasi;
            const jam      = btn.dataset.jam;
            const harga    = btn.dataset.harga;
            const foto     = btn.dataset.foto;

            // isi hidden input service_id
            serviceIdInput.value = id;

            // isi info jasa di modal
            if (jasaNamaEl)     jasaNamaEl.textContent = nama || '';
            if (jasaKategoriEl) jasaKategoriEl.textContent = kategori || '-';
            if (jasaLokasiEl)   jasaLokasiEl.textContent = lokasi || '-';
            if (jasaJamEl)      jasaJamEl.textContent = jam || '-';

            if (jasaHargaEl) {
                if (harga) {
                    jasaHargaEl.textContent = 'Rp ' + Number(harga).toLocaleString('id-ID');
                } else {
                    jasaHargaEl.textContent = '-';
                }
            }

            if (jasaFotoEl && foto) {
                jasaFotoEl.src = foto;
            }
        });
    });
});
</script>
@endpush
