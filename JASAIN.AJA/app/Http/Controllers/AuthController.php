<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showAuthPage()
    {
        return view('auth.auth');
    }

    public function login(Request $request)
    {
        // Validasi input login
        $data = $request->validate(
            [
                'login'    => ['required', 'string'],
                'password' => ['required', 'string'],
            ],
            [
                'login.required'    => 'Nama atau email wajib diisi.',
                'password.required' => 'Password wajib diisi.',
            ]
        );

        $login    = $data['login'];
        $password = $data['password'];

        // Tentukan pakai email atau name
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        if (Auth::attempt([$field => $login, 'password' => $password])) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Contoh: kalau ada role admin, sesuaikan kebutuhanmu
            if (isset($user->role_id) && $user->role_id == 1) {
                return redirect()->route('admin.dashboard');
            }

            // Default redirect
            return redirect()->route('home');
        }

        // Kalau gagal login
        return back()
            ->withErrors([
                'auth' => 'Nama/email atau password salah.',
            ])
            ->withInput(); // penting agar old('mode') dan old('login') balik lagi
    }

    public function register(Request $request)
    {
        // Validasi register
        $data = $request->validate(
            [
                'name'                  => ['required', 'string', 'max:255'],
                'email'                 => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
                'password'              => ['required', 'string', 'min:6', 'confirmed'],
            ],
            [
                'name.required'         => 'Nama wajib diisi.',
                'email.required'        => 'Email wajib diisi.',
                'email.email'           => 'Format email tidak valid.',
                'email.unique'          => 'Email sudah terdaftar.',
                'password.required'     => 'Password wajib diisi.',
                'password.min'          => 'Password minimal 6 karakter.',
                'password.confirmed'    => 'Konfirmasi password tidak sama.',
            ]
        );

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            // Kalau kamu pakai kolom role_id, boleh pakai default
            'role_id'  => $data['role_id'] ?? 3,
        ]);

        Auth::login($user);

        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/auth');
    }
}
