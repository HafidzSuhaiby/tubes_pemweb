<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title')</title>

    {{-- Tailwind + Vite --}}
    @vite(['resources/css/app.css', 'resources/js/admin.js'])

    {{-- Font Awesome --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
          crossorigin="anonymous" />
</head>

<body class="bg-gray-100"
      data-success-message="{{ session('success') }}"
      data-error-message="{{ session('error') }}">

    <div class="flex flex-col min-h-screen">

        {{-- ================= NAVBAR ================= --}}
        <nav class="bg-white shadow-sm p-4 flex items-center justify-between relative z-20 font-fredoka">

            {{-- LOGO + DROPDOWN --}}
            <div class="flex items-center space-x-4">

                <div class="relative">
                    <button id="dropdown-toggle"
                            class="flex items-center space-x-2 focus:outline-none">

                        {{-- Logo --}}
                        <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center 
                                    justify-center text-white text-lg">
                            J
                        </div>

                        {{-- Nama Website --}}
                        <span class="text-xl font-semibold text-gray-800">
                            JASAIN.AJA
                        </span>

                        {{-- Ikon chevron --}}
                        <i id="dropdown-icon"
                           class="fa-solid fa-chevron-down fa-sm text-gray-500 transition-transform duration-300">
                        </i>
                    </button>

                    {{-- DROPDOWN SIDEBAR --}}
                    <div id="dropdown-menu"
                         class="absolute top-full left-0 mt-2 w-64 bg-white shadow-lg rounded-lg 
                                py-2 hidden z-30 transition-all">

                        <nav class="flex-1 px-2 py-2 space-y-1">

                            {{-- Dashboard --}}
                            <a href="{{ route('admin.dashboard') }}"
                               class="flex items-center space-x-3 px-4 py-2 rounded-lg
                                    text-gray-600 hover:bg-gray-100 hover:text-gray-900">
                                <i class="fa-solid fa-table-cells-large fa-fw"></i>
                                <span>Dashboard</span>
                            </a>

                            {{-- Data Admin --}}
                            <a href="{{ route('admin.users.index') }}"
                               class="flex items-center space-x-3 px-4 py-2 rounded-lg
                                    text-gray-600 hover:bg-gray-100 hover:text-gray-900">
                                <i class="fa-solid fa-users fa-fw"></i>
                                <span>Data Pengguna</span>
                            </a>

                            {{-- Data Jasa --}}
                            <a href="#"
                               class="flex items-center space-x-3 px-4 py-2 rounded-lg
                                    text-gray-600 hover:bg-gray-100 hover:text-gray-900">
                                <i class="fa-solid fa-briefcase fa-fw"></i>
                                <span>Data Jasa</span>
                            </a>

                            {{-- Data Pesanan --}}
                            <a href="#"
                               class="flex items-center space-x-3 px-4 py-2 rounded-lg
                                    text-gray-600 hover:bg-gray-100 hover:text-gray-900">
                                <i class="fa-solid fa-receipt fa-fw"></i>
                                <span>Data Pesanan</span>
                            </a>

                            {{-- Data Pendaftar Jasa --}}
                            <a href="{{ route('admin.pendaftar-jasa') }}"
                               class="flex items-center space-x-3 px-4 py-2 rounded-lg
                                    text-gray-600 hover:bg-gray-100 hover:text-gray-900">
                                <i class="fa-solid fa-file-lines fa-fw"></i>
                                <span>Pendaftar Jasa</span>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>

            {{-- ================== RIGHT SECTION ================== --}}
            <div class="flex items-center space-x-4">

                {{-- Notifikasi --}}
                <div class="relative p-1 text-gray-500 hover:text-gray-900 rounded-full">
                    <span class="absolute top-1.5 right-1 p-1 bg-red-500 animate-ping rounded-full opacity-75"></span>
                    <span class="absolute top-1.5 right-1 p-1 bg-red-500 rounded-full"></span>
                    <i class="fa-regular fa-bell fa-lg"></i>
                </div>

                {{-- Profile --}}
                <div class="relative">
                    <button id="profile-toggle"
                            class="flex items-center space-x-2 focus:outline-none">

                        <img class="w-8 h-8 rounded-full object-cover"
                             src="{{ Auth::user()->photo_profile
                                   ? asset('storage/profile/' . Auth::user()->photo_profile)
                                   : 'https://placehold.co/40x40/E2E8F0/718096?text=A' }}"
                             alt="Profile">

                        <span class="hidden sm:inline text-gray-800 font-medium">
                            {{ Auth::user()->name }}
                        </span>

                        <i id="profile-icon"
                           class="fa-solid fa-chevron-down fa-sm text-gray-500 transition-transform duration-300"></i>
                    </button>

                    {{-- Profile Menu --}}
                    <div id="profile-menu"
                        class="absolute top-full right-0 mt-2 w-48 bg-white shadow-lg rounded-lg py-2 hidden z-30">

                        {{-- My Profile --}}
                        <a href="#"
                        class="flex w-full items-center space-x-3 px-4 py-2 text-gray-600 hover:bg-gray-100 hover:text-gray-900 rounded-lg">
                            <i class="fa-solid fa-user fa-fw"></i>
                            <span>My Profile</span>
                        </a>

                        <div class="border-t my-1"></div>

                        {{-- Logout --}}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="flex w-full text-left items-center space-x-3 px-4 py-2 
                                        text-gray-600 hover:bg-gray-100 hover:text-gray-900 
                                        rounded-lg bg-transparent border-0 cursor-pointer">
                                <i class="fa-solid fa-right-from-bracket fa-fw"></i>
                                <span>Logout</span>
                            </button>
                        </form>

                    </div>

                </div>
            </div>
        </nav>

        {{-- ================= MAIN CONTENT ================= --}}
        <main class="flex-1 p-6">
            @yield('content')
        </main>

        {{-- ================= FOOTER ================= --}}
        <footer class="p-6 text-center text-sm text-gray-500 border-t">
            Copyright &copy; {{ date('Y') }} JASAIN.AJA. All Rights Reserved.
        </footer>

    </div>

</body>
</html>
