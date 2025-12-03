<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lupa Password - Kirim Kode</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/auth.css'])
</head>
<body>

<div class="auth-wrapper">
    <div class="forms sign-in">
        <h2>Lupa Password</h2>
        <p class="subtitle">
            Masukkan email yang terdaftar. Kami akan mengirimkan kode verifikasi untuk reset password.
        </p>

        @if (session('status'))
            <p class="success-message">{{ session('status') }}</p>
        @endif

        @error('auth')
            <p class="error-message">{{ $message }}</p>
        @enderror

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="input-group">
                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    class="@error('email') input-error @enderror"
                >
                @error('email')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary" style="margin-top: 8px;">
                Kirim kode verifikasi
            </button>

            <div class="mt-4">
                <a href="{{ route('auth.show') }}">← Kembali ke halaman login</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
