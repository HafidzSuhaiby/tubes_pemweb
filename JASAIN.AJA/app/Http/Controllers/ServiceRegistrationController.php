<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceRegistration;
use Illuminate\Support\Facades\Auth;

class ServiceRegistrationController extends Controller
{
    public function store(Request $request)
    {
        // ========== VALIDASI DASAR ==========
        $request->validate([
            // Step 1 – Informasi pribadi (optional)
            'nama'      => 'nullable|string|max:255',
            'username'  => 'nullable|string|max:255',
            'email'     => 'nullable|email',
            'telepon'   => 'nullable|string|max:50',
            'alamat'    => 'nullable|string',

            // Step 2 – Informasi jasa
            'nama_jasa'     => 'required|string|max:255',
            'kategori'      => 'nullable|string|max:255',
            'deskripsi'     => 'nullable|string',
            'pengalaman'    => 'nullable|integer|min:0|max:99',
            'harga_mulai'   => 'nullable|integer|min:0',

            // Step 3 – Lokasi
            'kota'              => 'nullable|string|max:255',
            'area_layanan'      => 'nullable|string',
            'hari_kerja'        => 'nullable|string|max:255',
            'jam_operasional'   => 'nullable|string|max:255',

            // Step 4 – Verifikasi
            'ktp'          => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'foto_jasa.*'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'setuju'       => 'required|boolean',
        ]);

        // ========== UPLOAD KTP ==========
        $ktpPath = null;
        if ($request->hasFile('ktp')) {
            // disimpan di storage/app/public/uploads/ktp
            $ktpPath = $request->file('ktp')->store('uploads/ktp', 'public');
        }

        // ========== UPLOAD FOTO JASA MULTIPLE ==========
        $fotoJasaPaths = [];
        if ($request->hasFile('foto_jasa')) {
            foreach ($request->file('foto_jasa') as $foto) {
                // disimpan di storage/app/public/uploads/foto_jasa
                $path = $foto->store('uploads/foto_jasa', 'public');
                $fotoJasaPaths[] = $path;
            }
        }

        // ========== SIMPAN DATA KE DATABASE ==========
        ServiceRegistration::create([
            'user_id' => Auth::id(), // user login

            // Step 2
            'nama_jasa'     => $request->nama_jasa,
            'kategori'      => $request->kategori,
            'deskripsi'     => $request->deskripsi,
            'pengalaman'    => $request->pengalaman,
            'harga_mulai'   => $request->harga_mulai,

            // Step 3
            'kota'              => $request->kota,
            'area_layanan'      => $request->area_layanan,
            'hari_kerja'        => $request->hari_kerja,
            'jam_operasional'   => $request->jam_operasional,

            // Step 4
            'ktp_path'          => $ktpPath,
            'foto_jasa_paths'   => $fotoJasaPaths,        // ⬅⬅ TANPA json_encode
            'setuju'            => $request->setuju ? true : false,

            // default
            'status' => 'pending',
        ]);

        return redirect()
            ->route('daftar-jasa')
            ->with('success', 'Pendaftaran jasa berhasil dikirim, menunggu persetujuan admin.');
    }
}
