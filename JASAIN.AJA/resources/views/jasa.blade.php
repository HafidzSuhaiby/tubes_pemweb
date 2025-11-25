@extends('layouts.main')
@section('title', 'Jasain Aja - Solusi Semua Jasa')

{{-- =====================================
    BANNER SLIDER (FULL WIDTH)
====================================== --}}
@section('banner')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<style>
    .banner-full {
        width: 100vw;
        position: relative;
        left: 50%;
        margin-left: -50vw;
        overflow: hidden;
        background-color: #0b1e4a;
    }

    .banner-full .swiper {
        width: 100%;
        height: 420px;
    }

    .banner-full .swiper-slide {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100% !important;
        height: 100% !important;
    }

    .banner-full img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .swiper-button-next,
    .swiper-button-prev {
        color: white !important;
    }

    .swiper-pagination-bullet {
        background: white !important;
        opacity: 0.7;
    }

    .swiper-pagination-bullet-active {
        background: #007bff !important;
        opacity: 1;
    }
</style>

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

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
new Swiper(".mySwiper", {
    loop: true,
    autoplay: { delay: 2500, disableOnInteraction: false },
    slidesPerView: 1,
    pagination: { el: ".swiper-pagination", clickable: true },
    navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
});
</script>

@endsection



{{-- =====================================
    HALAMAN KONTEN
====================================== --}}
@section('content')

<style>
    body {
        background: #d9dfec !important;
    }

    .card-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 20px;
    }

    @media (max-width: 1200px) {
        .card-grid { grid-template-columns: repeat(4, 1fr); }
    }
    @media (max-width: 992px) {
        .card-grid { grid-template-columns: repeat(3, 1fr); }
    }
    @media (max-width: 768px) {
        .card-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 576px) {
        .card-grid { grid-template-columns: repeat(1, 1fr); }
    }

    .card-item img {
        height: 140px;
        object-fit: cover;
    }
</style>

<div class="container py-5">

    <div class="text-center mb-5">
        <h1 class="fw-bold text-dark">Pilih Jasa Sesuai</h1>
        <p class="text-secondary fs-5">Kebutuhan Anda...</p>
    </div>

    {{-- FILTER --}}
    <div class="d-flex flex-wrap justify-content-center gap-3 mb-4">

        <select id="filterKategori" class="form-select w-auto">
            <option value="">Semua Kategori</option>
            <option value="Sedot WC">Sedot WC</option>
            <option value="Cleaning">Cleaning</option>
            <option value="Service AC">Service AC</option>
            <option value="Pipa">Perbaikan Pipa</option>
        </select>

        <select id="filterArea" class="form-select w-auto">
            <option value="">Semua Area</option>
            <option value="Jakarta">Jakarta</option>
            <option value="Bandung">Bandung</option>
            <option value="Surabaya">Surabaya</option>
        </select>

        <button onclick="applyFilter()" class="btn btn-dark px-4">OK</button>
    </div>

    {{-- CARD GRID --}}
    @php
        $lokasiList = ['Jakarta','Bandung','Surabaya','Jakarta','Bandung','Surabaya','Jakarta','Bandung','Surabaya','Jakarta'];
    @endphp

    <div class="card-grid-wrapper">
    <div class="card-grid">


        @for($i = 0; $i < 10; $i++)
            @php $lokasi = $lokasiList[$i]; @endphp

            <div class="card-item card shadow-sm border-0 h-100"
                data-kategori="Sedot WC"
                data-lokasi="{{ $lokasi }}"
                style="background:#0f1b33; color:white;">

                <img src="{{ asset('images/jasa1.png') }}" class="card-img-top" alt="Jasa">

                <div class="card-body d-flex flex-column">
                    <h5 class="card-title fw-bold mb-1">Sedot WC</h5>
                    <p class="card-text text-light mb-3" style="font-size: 0.9rem;">
                        Sedot WC, Service Mesin WC...
                    </p>

                    <p class="mb-1"><strong>Lokasi:</strong> {{ $lokasi }}</p>
                    <p class="mb-1"><strong>Operasional:</strong> 08:00–20:00</p>
                    <p class="mb-3"><strong>Harga:</strong> 150.000–350.000</p>

                    <button class="btn btn-primary w-100 mt-auto">Booking Sekarang</button>
                </div>
            </div>
        @endfor

    </div>

</div>



{{-- FOOTER BAR --}}
<div class="footer-bar-full">

    <div class="footer-inner">

        <img src="{{ asset('images/logo-jasain.png') }}" class="footer-logo">

        <div class="footer-text">
            <span>Di Jasain.aja semua bisa</span>
        </div>

        <img src="{{ asset('images/footer.png') }}" class="footer-girl">

    </div>

</div>

<style>
.footer-bar-full {
    width: 100vw;
    position: relative;
    left: 50%;
    margin-left: -50vw;
    background-color: #0c1c3b;
    padding: 18px 0;
    margin-top: 40px;
}

.footer-inner {
    max-width: 1300px;
    margin: auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 25px;
}

.footer-logo {
    width: 70px;
}

.footer-text {
    font-size: 30px;
    font-weight: 700;
    color: white;
    text-align: center;
    flex-grow: 1;
}

.footer-girl {
    width: 120px;
    margin-right: -10px;
}

@media (max-width: 768px) {
    .footer-inner {
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }
}
</style>
<style>
html, body {
    height: auto !important;
    min-height: 100vh !important; /* penting supaya body lebih tinggi dari layar */
    overflow-y: auto !important;
}

.page-wrapper {
    min-height: 100vh !important; /* min-height kembali ke normal */
    height: auto !important;
    overflow-y: visible !important;
    display: flex !important;     /* KEMBALIKAN FLEX agar layout normal */
    flex-direction: column !important;
}
</style>

{{-- FILTER SCRIPT --}}
<script>
function applyFilter() {
    let kategori = document.getElementById("filterKategori").value;
    let lokasi   = document.getElementById("filterArea").value;

    document.querySelectorAll(".card-item").forEach(card => {
        const cardKategori = card.dataset.kategori;
        const cardLokasi   = card.dataset.lokasi;

        const cocokKategori = !kategori || cardKategori === kategori;
        const cocokLokasi   = !lokasi   || cardLokasi === lokasi;

        card.style.display = (cocokKategori && cocokLokasi) ? "" : "none";
    });
}
</script>

@endsection
