<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Jasain Aja')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap 5 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Icon Bootstrap (kalau mau pakai bi bi-person dsb) --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    {{-- Custom CSS via Vite --}}
    @vite(['resources/css/home.css', 'resources/js/home.js'])

    @stack('styles')
</head>
<body>

<div class="page-wrapper d-flex flex-column min-vh-100">

    {{-- NAVBAR GLOBAL --}}
    <nav class="navbar navbar-expand-lg navbar-dark nav-main">
        <div class="container px-4 px-lg-5">

            {{-- Logo + Brand --}}
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/home') }}">
                <img src="{{ asset('images/logo-jasain.png') }}" alt="Jasain Aja" class="logo-nav me-2">
                <div class="d-flex flex-column lh-1">
                    <span class="brand-title">JASAIN AJA</span>
                    <small class="brand-sub">Solusi Semua Jasa</small>
                </div>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarMain" aria-controls="navbarMain"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            {{-- Menu --}}
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center gap-lg-3">
                    <li class="nav-item">
                        <a class="nav-link @if(request()->is('home')) active @endif" href="{{ url('/home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->is('tentang')) active @endif" href="{{ url('/tentang') }}">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->is('jasa')) active @endif" href="{{ url('/jasa') }}">Jasa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->is('daftar-jasa')) active @endif" href="{{ url('/daftar-jasa') }}">Daftar Jasa</a>
                    </li>

                    {{-- Icon user di kanan (sementara dummy) --}}
                    <li class="nav-item ms-lg-3">
                        <a class="nav-icon-circle d-inline-flex align-items-center justify-content-center" href="#">
                            <i class="bi bi-person"></i>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

    {{-- KONTEN HALAMAN --}}
    @yield('content')

</div>

{{-- Bootstrap 5 JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')
</body>
</html>
