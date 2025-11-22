<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    // LIST DATA PENGGUNA
    public function index()
    {
        $users = User::with('role')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin_page.user_data.user_data', compact('users'));
    }

    // FORM EDIT
    public function edit(User $user)
    {
        return view('admin_page.user_data.user_edit', compact('user'));
    }

    // UPDATE DATA
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'role_id'  => 'nullable|integer',
        ]);

        $user->update([
            'name'    => $request->name,
            'email'   => $request->email,
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Data pengguna berhasil diperbarui.');
    }

    // HAPUS DATA
    public function destroy(User $user)
    {
        // opsional: cegah hapus akun sendiri
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Pengguna berhasil dihapus.');
    }
}