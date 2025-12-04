<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Auth</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/auth.css', 'resources/js/auth.js']); ?>
</head>
<body>

<div class="auth-wrapper" id="authWrapper">

    
    <div class="forms sign-in">
        <h2>LOGIN </h2>
        <p class="subtitle">Masukkan email dan password dengan benar!</p>

        <form method="POST" action="<?php echo e(route('login')); ?>">
            <?php echo csrf_field(); ?>
            <div class="input-group">
                <label for="login_email">Email</label>
                <input type="email" id="login_email" name="email" placeholder="you@example.com" required>
            </div>

            <div class="input-group">
                <label for="login_password">Password</label>
                <input type="password" id="login_password" name="password" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn btn-primary" style="margin-top: 8px;">MASUK</button>
        </form>
    </div>

    
    <div class="forms sign-up">
        <h2>Daftar Akun Anda</h2>

        <form method="POST" action="<?php echo e(route('register')); ?>">
            <?php echo csrf_field(); ?>
            <div class="input-group">
                <label for="register_name">Nama</label>
                <input type="text" id="register_name" name="name" placeholder="name" required>
            </div>

            <div class="input-group">
                <label for="register_email">Email</label>
                <input type="email" id="register_email" name="email" placeholder="you@example.com" required>
            </div>

            <div class="input-group">
                <label for="register_password">Password</label>
                <input type="password" id="register_password" name="password" placeholder="Create 6 leght password" required>
            </div>

            <div class="input-group">
                <label for="register_password_confirmation">Confirm Password</label>
                <input type="password" id="register_password_confirmation" name="password_confirmation" placeholder="Confirm password" required>
            </div>

            <button type="submit" class="btn btn-primary" style="margin-top: 8px;">DAFTARKAN</button>
        </form>
    </div>

    
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h2>Welcome JasaFam!</h2>
                 <p class="text-lg text-blue-100 max-w-sm leading-relaxed">
                 Sudah punya akun?</p>
                <button class="btn btn-outline" id="goToSignIn">MASUK</button>
            </div>

            <div class="overlay-panel overlay-right">
                <h2>Halo, JasaFam!</h2>
                <p class="text-lg text-blue-100 max-w-sm leading-relaxed">
                 Belum punya akun? Daftar sekarang dan mulai promosikan jasa kamu atau pesan layanan terbaik di Jasain.Aja!</p>
                <button class="btn btn-outline" id="goToSignUp">DAFTAR</button>
            </div>
        </div>
    </div>

</div>

</body>
</html>
<?php /**PATH D:\laragon\www\tubes_pemweb\JASAIN.AJA\resources\views/auth/auth.blade.php ENDPATH**/ ?>