<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Auth</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/auth.css', 'resources/js/auth.js'])
</head>
<body>

{{-- 
    old('mode'):
    - "login"    => tetap di form login
    - "register" => langsung tampil form register
--}}
<div class="auth-wrapper {{ old('mode') === 'register' ? 'sign-up-mode' : '' }}" id="authWrapper">

    {{-- FORM SIGN IN --}}
    <div class="forms sign-in">
        <h2>LOGIN</h2>
        <p class="subtitle">Masukkan email dan password dengan benar!</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="hidden" name="mode" value="login">

            {{-- NAMA / EMAIL --}}
            <div class="input-group">
                <label for="login_input">Nama / Email</label>
                <input
                    type="text"
                    id="login_input"
                    name="login"
                    placeholder="Masukkan nama atau email"
                    value="{{ old('login') }}"
                    class="@error('login') input-error @enderror @error('auth') input-error @enderror"
                    required
                >
                {{-- error field login kosong / invalid --}}
                @error('login')
                    <p class="error-message">{{ $message }}</p>
                @enderror
                {{-- error login gagal (duplikat di bawah kedua field) --}}
                @error('auth')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- PASSWORD --}}
            <div class="input-group">
                <label for="login_password">Password</label>
                <div class="password-wrapper">
                    <input
                        type="password"
                        id="login_password"
                        name="password"
                        placeholder="••••••••"
                        class="@error('password') input-error @enderror @error('auth') input-error @enderror"
                        required
                    >
                    <button
                        type="button"
                        class="toggle-password"
                        data-target="login_password"
                        aria-label="Tampilkan / sembunyikan password"
                    ></button>
                </div>
                @error('password')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>


            <div class="flex justify-end mt-1">
                <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">
                    Lupa password?
                </a>
            </div>

            <button type="submit" class="btn btn-primary" style="margin-top: 8px;">MASUK</button>

        </form>
    </div>

    {{-- FORM SIGN UP --}}
    <div class="forms sign-up">
        <h2>Daftar Akun Anda</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <input type="hidden" name="mode" value="register">

            {{-- NAMA --}}
            <div class="input-group">
                <label for="register_name">Nama</label>
                <input
                    type="text"
                    id="register_name"
                    name="name"
                    placeholder="Nama lengkap"
                    value="{{ old('name') }}"
                    class="@error('name') input-error @enderror"
                    required
                >
                @error('name')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- EMAIL --}}
            <div class="input-group">
                <label for="register_email">Email</label>
                <input
                    type="email"
                    id="register_email"
                    name="email"
                    placeholder="you@example.com"
                    value="{{ old('email') }}"
                    class="@error('email') input-error @enderror"
                    required
                >
                @error('email')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- PASSWORD --}}
            <div class="input-group">
                <label for="register_password">Password</label>
                <div class="password-wrapper">
                    <input
                        type="password"
                        id="register_password"
                        name="password"
                        placeholder="Minimal 6 karakter"
                        class="@error('password') input-error @enderror"
                        required
                    >
                    <button
                        type="button"
                        class="toggle-password"
                        data-target="register_password"
                        aria-label="Tampilkan / sembunyikan password"
                    ></button>
                </div>
                @error('password')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- KONFIRMASI PASSWORD --}}
            <div class="input-group">
                <label for="register_password_confirmation">Confirm Password</label>
                <div class="password-wrapper">
                    <input
                        type="password"
                        id="register_password_confirmation"
                        name="password_confirmation"
                        placeholder="Ulangi password"
                        required
                    >
                    <button
                        type="button"
                        class="toggle-password"
                        data-target="register_password_confirmation"
                        aria-label="Tampilkan / sembunyikan password"
                    ></button>
                </div>

                @error('password_confirmation')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>


            <button type="submit" class="btn btn-primary" style="margin-top: 8px;">DAFTARKAN</button>
        </form>
    </div>

    {{-- OVERLAY --}}
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h2>Welcome JasaFam!</h2>
                <p class="text-lg text-blue-100 max-w-sm leading-relaxed">
                    Sudah punya akun?
                </p>
                <button class="btn btn-outline" id="goToSignIn">MASUK</button>
            </div>

            <div class="overlay-panel overlay-right">
                <h2>Halo, JasaFam!</h2>
                <p class="text-lg text-blue-100 max-w-sm leading-relaxed">
                    Belum punya akun? Daftar sekarang dan mulai promosikan jasa kamu atau pesan layanan terbaik di Jasain.Aja!
                </p>
                <button class="btn btn-outline" id="goToSignUp">DAFTAR</button>
            </div>
        </div>
    </div>

</div>

</body>
</html>
