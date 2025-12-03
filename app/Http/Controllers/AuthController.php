<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    // =========================
    // HALAMAN LOGIN / REGISTER
    // =========================
    public function showAuthPage()
    {
        return view('auth.auth');
    }

    // =========================
    // PROSES LOGIN
    // =========================
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

        // Coba login biasa
        if (Auth::attempt([$field => $login, 'password' => $password])) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Jika punya role admin
            if (isset($user->role_id) && $user->role_id == 1) {
                return redirect()->route('admin.dashboard');
            }

            // Default redirect user biasa
            return redirect()->route('home');
        }

        // Kalau gagal login → user bisa klik "Lupa password?"
        return back()
            ->withErrors([
                'auth' => 'Nama/email atau password salah.',
            ])
            ->withInput();
    }

    // =========================
    // REGISTER
    // =========================
    public function register(Request $request)
    {
        $data = $request->validate(
            [
                'name'     => ['required', 'string', 'max:255'],
                'email'    => ['required', 'email', 'unique:users,email'],
                'password' => ['required', 'min:6', 'confirmed'],
            ]
        );

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id'  => $data['role_id'] ?? 3,
        ]);

        Auth::login($user);

        return redirect()->route('home');
    }

    // =========================
    // LOGOUT
    // =========================
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/auth');
    }

    // =========================
    // FORM LUPA PASSWORD (INPUT EMAIL)
    // =========================
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    // =========================
    // KIRIM KODE VERIFIKASI KE EMAIL
    // =========================
    public function sendForgotCode(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()
                ->withErrors(['email' => 'Email tidak terdaftar.'])
                ->withInput();
        }

        // generate kode 6 digit
        $code = rand(100000, 999999);

        // simpan ke session
        $request->session()->put('forgot_password', [
            'user_id'    => $user->id,
            'email'      => $user->email,
            'code'       => $code,
            'expires_at' => now()->addMinutes(10)->timestamp, // berlaku 10 menit
        ]);

        // kirim email berisi kode
        Mail::raw("Kode verifikasi untuk reset password Anda adalah: {$code}", function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('Kode Verifikasi Reset Password');
        });

        return redirect()->route('password.reset.code.form')
            ->with('status', 'Kode verifikasi telah dikirim ke email Anda.');
    }

    // =========================
    // FORM RESET PASSWORD (ISI KODE + PASSWORD BARU)
    // =========================
    public function showResetFormWithCode(Request $request)
    {
        $data = $request->session()->get('forgot_password');

        if (!$data) {
            return redirect()->route('password.request')
                ->withErrors(['email' => 'Sesi reset password tidak ditemukan. Silakan minta kode baru.']);
        }

        return view('auth.reset-password', [
            'email' => $data['email'],
        ]);
    }

    // =========================
    // PROSES RESET PASSWORD DENGAN KODE
    // =========================
    public function resetPasswordWithCode(Request $request)
    {
        $request->validate([
            'code'     => ['required', 'digits:6'],
            'password' => ['required', 'min:6', 'confirmed'],
        ], [
            'code.required'     => 'Kode verifikasi wajib diisi.',
            'code.digits'       => 'Kode verifikasi harus 6 digit.',
            'password.required' => 'Password baru wajib diisi.',
            'password.min'      => 'Password baru minimal 6 karakter.',
            'password.confirmed'=> 'Konfirmasi password baru tidak sama.',
        ]);

        $data = $request->session()->get('forgot_password');

        if (!$data) {
            return redirect()->route('password.request')
                ->withErrors(['email' => 'Sesi reset password tidak ditemukan. Silakan minta kode baru.']);
        }

        // cek expired
        if (now()->timestamp > $data['expires_at']) {
            $request->session()->forget('forgot_password');

            return redirect()->route('password.request')
                ->withErrors(['email' => 'Kode verifikasi sudah kedaluwarsa. Silakan minta kode baru.']);
        }

        // cek kode
        if ($request->code != $data['code']) {
            return back()->withErrors(['code' => 'Kode verifikasi salah.'])->withInput();
        }

        $user = User::find($data['user_id']);

        if (!$user) {
            $request->session()->forget('forgot_password');

            return redirect()->route('auth.show')
                ->withErrors(['auth' => 'User tidak ditemukan.']);
        }

        // update password
        $user->password = Hash::make($request->password);
        $user->save();

        // hapus sesi forgot_password
        $request->session()->forget('forgot_password');

        return redirect()->route('auth.show')
            ->with('status', 'Password berhasil direset. Silakan login dengan password baru.');
    }
}
