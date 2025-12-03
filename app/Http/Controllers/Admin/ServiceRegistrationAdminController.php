<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceRegistration;
use Illuminate\Http\Request;

class ServiceRegistrationAdminController extends Controller
{
    public function index()
    {
        $registrations = ServiceRegistration::with('user')->latest()->get();

        return view('admin_page.data_pendaftar_jasa.pendaftar_jasa', compact('registrations'));
    }
    public function show($id)
    {
        $reg = ServiceRegistration::with('user')->findOrFail($id);

        return view('admin_page.data_pendaftar_jasa.pendaftar_jasa_show', compact('reg'));
    }


    public function approve($id)
    {
        $reg = ServiceRegistration::findOrFail($id);
        $reg->status = 'approved';
        $reg->save();

        return back()->with('success', 'Pendaftar jasa disetujui.');
    }

    public function reject($id)
    {
        $reg = ServiceRegistration::findOrFail($id);
        $reg->status = 'rejected';
        $reg->save();

        return back()->with('success', 'Pendaftar jasa ditolak.');
    }
    public function destroy($id)
    {
        $reg = ServiceRegistration::findOrFail($id);

        if ($reg->status !== 'rejected') {
            return back()->with('error', 'Hanya pendaftar dengan status ditolak yang bisa dihapus.');
        }

        $reg->delete();

        return back()->with('success', 'Pendaftaran jasa berhasil dihapus.');
    }

    // LIST JASA YANG SUDAH DISETUJUI
    public function approvedIndex()
    {
        $services = ServiceRegistration::with('user')
                    ->where('status', 'approved')
                    ->latest()
                    ->paginate(10);

        return view('admin_page.data_jasa.data_jasa', compact('services'));
    }

    public function toggleActive($id)
    {
        $service = ServiceRegistration::findOrFail($id);

        $service->is_active = !$service->is_active;
        $service->save();

        return back()->with('success', 'Status jasa berhasil diperbarui.');
    }
}
