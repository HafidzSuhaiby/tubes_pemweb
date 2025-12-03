<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Reset Password dengan Kode</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/auth.css'])
</head>
<body>

<div class="auth-wrapper">
    <div class="forms sign-in">
        <h2>Reset Password</h2>
        <p class="subtitle">
            Masukkan kode verifikasi yang dikirim ke email Anda, lalu buat password baru.
        </p>

        @if (session('status'))
            <p class="success-message">{{ session('status') }}</p>
        @endif

        <form method="POST" action="{{ route('password.reset.code.update') }}">
            @csrf

            {{-- EMAIL (hanya ditampilkan info, diambil dari session di controller) --}}
            @isset($email)
                <div class="input-group">
                    <label>Email</label>
                    <input type="email" value="{{ $email }}" disabled>
                </div>
            @endisset

            {{-- KODE VERIFIKASI --}}
            <div class="input-group">
                <label for="code">Kode verifikasi (6 digit)</label>
                <input
                    type="text"
                    id="code"
                    name="code"
                    maxlength="6"
                    value="{{ old('code') }}"
                    required
                    class="@error('code') input-error @enderror"
                >
                @error('code')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- PASSWORD BARU --}}
            <div class="input-group">
                <label for="password">Password baru</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    class="@error('password') input-error @enderror"
                >
                @error('password')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- KONFIRMASI PASSWORD BARU --}}
            <div class="input-group">
                <label for="password_confirmation">Konfirmasi password baru</label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    required
                >
            </div>

            <button type="submit" class="btn btn-primary" style="margin-top: 8px;">
                Simpan password baru
            </button>

            <div class="mt-4">
                <a href="{{ route('auth.show') }}">← Kembali ke halaman login</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
