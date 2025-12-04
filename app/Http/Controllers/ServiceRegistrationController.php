<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceRegistration;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class ServiceRegistrationController extends Controller
{
    public function store(Request $request)
    {
        // Cek user sudah pernah daftar jasa atau belum
        $sudahDaftar = ServiceRegistration::where('user_id', Auth::id())->exists();

        if ($sudahDaftar) {
            return redirect()
                ->route('daftar-jasa')
                ->with('error', 'Anda sudah Mendaftar Jasa. Silakan cek status pendaftaran');
        }

        // ========== VALIDASI DASAR ==========
        $request->validate([
            // Step 1 – Informasi pribadi
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

            // Step 4 – Verifikasi & file
            'ktp'              => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'foto_jasa.*'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'portofolio.*'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'setuju'           => 'required|boolean',
        ]);

        // ========== UPDATE DATA USER (INFORMASI PRIBADI) ==========
        $user = Auth::user();
        $userUpdate = [];

        if ($request->filled('nama') && $user->name !== $request->nama) {
            $userUpdate['name'] = $request->nama;
        }

        if ($request->filled('username') && $user->username !== $request->username) {
            $userUpdate['username'] = $request->username;
        }

        if ($request->filled('telepon') && $user->telepon !== $request->telepon) {
            $userUpdate['telepon'] = $request->telepon;
        }

        if ($request->filled('alamat') && $user->alamat !== $request->alamat) {
            $userUpdate['alamat'] = $request->alamat;
        }

        if (!empty($userUpdate)) {
            $user->update($userUpdate);
        }

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
                $path = $foto->store('uploads/foto_jasa', 'public');
                $fotoJasaPaths[] = $path;
            }
        }

        // ========== UPLOAD PORTOFOLIO MULTIPLE ==========
        $portofolioPaths = [];
        if ($request->hasFile('portofolio')) {
            foreach ($request->file('portofolio') as $foto) {
                $path = $foto->store('uploads/portofolio', 'public');
                $portofolioPaths[] = $path;
            }
        }

        // ========== SIMPAN DATA PENDAFTARAN JASA ==========
        ServiceRegistration::create([
            'user_id'           => $user->id,

            // Step 2
            'nama_jasa'         => $request->nama_jasa,
            'kategori'          => $request->kategori,
            'deskripsi'         => $request->deskripsi,
            'pengalaman'        => $request->pengalaman,
            'harga_mulai'       => $request->harga_mulai,

            // Step 3
            'kota'              => $request->kota,
            'area_layanan'      => $request->area_layanan,
            'hari_kerja'        => $request->hari_kerja,
            'jam_operasional'   => $request->jam_operasional,

            // Step 4 (file)
            'ktp_path'          => $ktpPath,
            'foto_jasa_paths'   => $fotoJasaPaths,      // array, pakai cast di model
            'portofolio_paths'  => $portofolioPaths,    // array juga
            'setuju'            => $request->setuju ? true : false,

            'status'            => 'pending',
        ]);

        return redirect()
            ->route('daftar-jasa')
            ->with('success', 'Pendaftaran jasa berhasil dikirim, menunggu persetujuan admin.');
    }

    public function create()
    {
        $registration = ServiceRegistration::where('user_id', Auth::id())->first();

        return view('daftar-jasa', [
            'registration' => $registration,
        ]);
    }


    public function approve($id)
    {
        $reg = ServiceRegistration::with('user')->findOrFail($id);
        $reg->status = 'approved';
        $reg->save();

        // ubah role user menjadi penyedia jasa
        $user = $reg->user;

        if ($user) {
            $penyediaRole = Role::where('nama_role', 'penyedia')->first();

            if ($penyediaRole) {
                $user->role_id = $penyediaRole->id;
                $user->save();
            }
        }

        return redirect()
            ->route('admin.pendaftar-jasa.show', $id)
            ->with('success', 'Pendaftaran jasa telah disetujui.');
    }
    public function myService()
    {
        $registration = ServiceRegistration::where('user_id', Auth::id())
            ->where('status', 'approved') // hanya yang sudah disetujui
            ->first();

        // kalau belum ada yang approved
        if (!$registration) {
            return redirect()
                ->route('daftar-jasa')
                ->with('error', 'Pendaftaran jasa Anda belum disetujui admin.');
        }

        return view('jasa-saya', [
            'registration' => $registration,
        ]);
    }

}
