<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class HakAkses
{
    /**
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  mixed  ...$roles
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Kalau belum login
        if (!Auth::check()) {
            // di project kamu, halaman login utamanya 'auth.show'
            return redirect()->route('auth.show');
        }

        $user = Auth::user();

        // Ambil relasi role (singular)
        $roleRelation = $user->role ?? $user->roles ?? null;

        if (!$roleRelation) {
            abort(403, 'Role untuk user ini tidak diatur.');
        }

        // Ambil nama role dari kolom nama_role
        $userRole = $roleRelation->nama_role ?? $roleRelation->name_role ?? null;

        if (!$userRole) {
            abort(403, 'Nama role tidak ditemukan.');
        }

        // Biar nggak sensitif huruf besar/kecil
        $userRole = strtolower($userRole);               // misal: "admin"
        $allowedRoles = array_map('strtolower', $roles); // misal: ["admin"]

        if (!in_array($userRole, $allowedRoles)) {
            abort(403, 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        return $next($request);
    }
}
