<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceRegistration;

class JasaController extends Controller
{
    public function index()
    {
        $services = ServiceRegistration::where('status', 'approved')
            ->where('is_active', true)
            ->latest()
            ->get();
        
        $kategoriList = $services->pluck('kategori_label')
            ->filter()
            ->unique()
            ->values();

        $areaList = $services->pluck('kota')
            ->filter()
            ->unique()
            ->values();

            return view('jasa', compact('services', 'kategoriList', 'areaList'));
    }
}
