@extends('layouts.main')

@section('title', 'Jasain Aja - Solusi Semua Jasa')

@section('content')
    {{-- HERO SECTION --}}
    <main class="hero-section position-relative flex-grow-1"
          style="background-image: url('{{ asset('images/hero-bg.jpeg') }}');">

        <div class="hero-overlay"></div>

        <div class="container h-100 position-relative">
            <div class="row h-100 align-items-center py-5">

                {{-- Kiri: teks --}}
                <div class="col-lg-6 text-white hero-text">
                    <h1 class="hero-title fw-bold mb-3">
                        Selamat Datang<br>
                        JasaWarior!!
                    </h1>

                    <p class="hero-subtext mb-4">
                        “Terima kasih sudah mempercayai Jasain.Aja sebagai platform untuk mempromosikan jasa Anda.

                </div>

                {{-- Kanan: shape biru + foto --}}
                <div class="col-lg-6 d-flex justify-content-lg-end justify-content-center mt-5 mt-lg-0">

                    <div class="position-relative d-flex justify-content-center align-items-center"
                         style="width: 520px; height: 580px;">

                        {{-- SHAPE --}}
                        <svg viewBox="0 0 658 685"
                             class="position-absolute w-100 h-100 z-10"
                             style="pointer-events: none;">
                            <path d="M68.1846 492.779C-52.5763 481.132 -1.53033 393.135 132.155 131.732C265.841 -129.672 450.703 78.6746 450.703 78.6746C450.703 78.6746 466.369 208.729 611.935 289.609C757.501 370.489 515.979 578.188 466.369 601.481C416.759 624.774 313.623 661.656 230.722 652.597C147.822 643.539 188.946 504.425 68.1846 492.779Z"
                                  fill="#1F3C88" />
                        </svg>

                        {{-- FOTO --}}
                        <img src="{{ asset('images/pekerja.png') }}"
                             alt="pekerja"
                             class="position-relative img-fluid z-20"
                             style="width: 75%; height: auto; transform: translateY(40px);">
                    </div>

                </div>

            </div>
        </div>
    </main>
@endsection
