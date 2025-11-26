<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Jasain Aja')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap 5 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    {{-- Font Awesome --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        crossorigin="anonymous" />

    {{-- Custom --}}
    @vite(['resources/css/home.css', 'resources/js/home.js'])

    @stack('styles')
</head>
<body>

<div class="d-flex flex-column min-vh-100 page-wrapper">

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg navbar-dark nav-main">
        <div class="container px-4 px-lg-5">

            {{-- Logo --}}
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/home') }}">
                <img src="{{ asset('images/logo-jasain.png') }}" alt="Jasain Aja" class="logo-nav me-2">
                <div class="d-flex flex-column lh-1">
                    <span class="brand-title">JASAIN AJA</span>
                    <small class="brand-sub">Solusi Semua Jasa</small>
                </div>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>

            {{-- MENU --}}
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center gap-lg-3">

                    @auth
                        @php
                            $user = auth()->user();
                            $role = optional($user->role)->nama_role;
                            // nilai: admin / penyedia / pelanggan
                        @endphp

                        {{-- Always show --}}
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('home') ? 'active' : '' }}"
                            href="{{ url('/home') }}">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('tentang') ? 'active' : '' }}"
                            href="{{ url('/tentang') }}">Tentang Kami</a>
                        </li>

                        {{-- If role = penyedia → TAMPILKAN JASA SAYA --}}
                        @if($role === 'penyedia')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('jasa-saya') ? 'active' : '' }}"
                                href="{{ route('jasa-saya') }}">
                                    Jasa Saya
                                </a>
                            </li>

                        {{-- Selain penyedia (pelanggan) → tampilkan Jasa + Daftar Jasa --}}
                        @else
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('jasa') ? 'active' : '' }}"
                                href="{{ url('/jasa') }}">Jasa</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('daftar-jasa') ? 'active' : '' }}"
                                href="{{ route('daftar-jasa') }}">Daftar Jasa</a>
                            </li>
                        @endif
                    @endauth


                    {{-- ============= GUEST ============= --}}
                    @guest
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('home') ? 'active' : '' }}"
                            href="{{ url('/home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('tentang') ? 'active' : '' }}"
                            href="{{ url('/tentang') }}">Tentang Kami</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('jasa') ? 'active' : '' }}"
                            href="{{ url('/jasa') }}">Jasa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('daftar-jasa') ? 'active' : '' }}"
                            href="{{ url('/daftar-jasa') }}">Daftar Jasa</a>
                        </li>
                    @endguest


                    {{-- ============= AUTH USER (Profile & Notifikasi) ============= --}}
                    @auth
                        {{-- Notifikasi --}}
                        <li class="nav-item d-flex align-items-center">
                            <div class="position-relative p-1">
                                <span class="position-absolute top-0 end-0 p-1 bg-danger rounded-circle" style="opacity:.75;"></span>
                                <span class="position-absolute top-0 end-0 p-1 bg-danger rounded-circle"></span>
                                <i class="fa-regular fa-bell fa-lg text-white"></i>
                            </div>
                        </li>

                        {{-- USER DROPDOWN --}}
                        <li class="nav-item dropdown">
                            <button class="btn btn-link nav-link dropdown-toggle d-flex align-items-center gap-2"
                                    data-bs-toggle="dropdown">

                                <img
                                    src="{{ Auth::user()->photo_profile
                                        ? asset('storage/profile/' . Auth::user()->photo_profile)
                                        : 'https://placehold.co/40x40/E2E8F0/718096?text=' . strtoupper(substr(Auth::user()->name, 0, 1)) }}"
                                    alt="Profile"
                                    class="rounded-circle"
                                    width="32" height="32">

                                <span class="fw-medium">{{ Auth::user()->name }}</span>
                            </button>

                            <ul class="dropdown-menu dropdown-menu-end shadow">
                                <li>
                                    <a class="dropdown-item d-flex align-items-center gap-2" href="#">
                                        <i class="fa-solid fa-user"></i> My Profile
                                    </a>
                                </li>

                                <li><hr class="dropdown-divider"></li>

                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item d-flex align-items-center gap-2">
                                            <i class="fa-solid fa-right-from-bracket"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endauth


                    {{-- LOGIN BUTTON --}}
                    @guest
                        <li class="nav-item ms-lg-3">
                            <a href="{{ route('auth.show') }}"
                                class="btn btn-outline-light btn-sm">
                                <i class="fa-solid fa-right-to-bracket me-1"></i> Login
                            </a>
                        </li>
                    @endguest
                </ul>
            </div>

        </div>
    </nav>


    {{-- ===== MAIN CONTENT HARUS FLEX-GROW ===== --}}
    <main class="flex-grow-1">
        @yield('banner')
        @yield('content')
    </main>

    {{-- FOOTER --}}
    @include('layouts.footer')


</div>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')
</body>
</html>
