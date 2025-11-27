<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserManagementController extends Controller
{
    // ========== ADMIN: LIST DATA PENGGUNA ==========
    public function index()
    {
        $users = User::with('role')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin_page.user_data.user_data', compact('users'));
    }

    // ========== ADMIN: FORM EDIT USER ==========
    public function edit(User $user)
    {
        return view('admin_page.user_data.user_edit', compact('user'));
    }

    // ========== ADMIN: UPDATE DATA USER ==========
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:users,email,' . $user->id,
            'role_id' => 'nullable|integer',
        ]);

        $user->update([
            'name'    => $request->name,
            'email'   => $request->email,
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Data pengguna berhasil diperbarui.');
    }

    // ========== ADMIN: HAPUS USER ==========
    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Pengguna berhasil dihapus.');
    }

    // ========== USER LOGIN: EDIT PROFIL SENDIRI ==========
    public function editProfile(Request $request)
    {
        $user = $request->user(); // user yang sedang login
        return view('profile.profile', compact('user'));
    }

    // ========== USER LOGIN: UPDATE PROFIL SENDIRI ==========
    public function updateProfile(Request $request)
    {
        $user = $request->user();

        // Validasi input sesuai kolom di DB
        $validated = $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'username'      => ['nullable', 'string', 'max:255'],
            'email'         => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'telepon'       => ['nullable', 'string', 'max:20'],
            'alamat'        => ['nullable', 'string', 'max:500'],
            'photo_profile' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'password'      => ['nullable', 'confirmed', 'min:8'],
        ]);

        // FOTO PROFIL → simpan di storage/app/public/uploads/foto_profile
        if ($request->hasFile('photo_profile')) {
            $file     = $request->file('photo_profile');
            $filename = time() . '.' . $file->getClientOriginalExtension();

            // PAKSA pakai disk "public"
            $file->storeAs('uploads/foto_profile', $filename, 'public');

            // Hapus foto lama jika ada
            \Illuminate\Support\Facades\Storage::disk('public')
                ->delete('uploads/foto_profile/' . $user->photo_profile);

            // simpan nama file ke database
            $validated['photo_profile'] = $filename;
        }

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }
}
