<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Auth</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/auth.css', 'resources/js/auth.js'])
</head>
<body>

<div class="auth-wrapper" id="authWrapper">

    {{-- FORM SIGN IN --}}
    <div class="forms sign-in">
        <h2>Sign In</h2>
        <p class="subtitle">Use your email and password to sign in.</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="input-group">
                <label for="login_email">Email</label>
                <input type="email" id="login_email" name="email" placeholder="you@example.com" required>
            </div>

            <div class="input-group">
                <label for="login_password">Password</label>
                <input type="password" id="login_password" name="password" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn btn-primary" style="margin-top: 8px;">SIGN IN</button>
        </form>
    </div>

    {{-- FORM SIGN UP --}}
    <div class="forms sign-up">
        <h2>Create Account</h2>
        <p class="subtitle">Register with your personal details to use all features.</p>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="input-group">
                <label for="register_name">Name</label>
                <input type="text" id="register_name" name="name" placeholder="Your name" required>
            </div>

            <div class="input-group">
                <label for="register_email">Email</label>
                <input type="email" id="register_email" name="email" placeholder="you@example.com" required>
            </div>

            <div class="input-group">
                <label for="register_password">Password</label>
                <input type="password" id="register_password" name="password" placeholder="Create a password" required>
            </div>

            <div class="input-group">
                <label for="register_password_confirmation">Confirm Password</label>
                <input type="password" id="register_password_confirmation" name="password_confirmation" placeholder="Confirm password" required>
            </div>

            <button type="submit" class="btn btn-primary" style="margin-top: 8px;">SIGN UP</button>
        </form>
    </div>

    {{-- OVERLAY --}}
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h2>Welcome Back!</h2>
                <button class="btn btn-outline" id="goToSignIn">SIGN IN</button>
            </div>

            <div class="overlay-panel overlay-right">
                <h2>Hello, Friend!</h2>
                <button class="btn btn-outline" id="goToSignUp">SIGN UP</button>
            </div>
        </div>
    </div>

</div>

</body>
</html>
