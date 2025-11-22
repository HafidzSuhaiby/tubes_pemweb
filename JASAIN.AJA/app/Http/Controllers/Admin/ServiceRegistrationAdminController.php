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
}
