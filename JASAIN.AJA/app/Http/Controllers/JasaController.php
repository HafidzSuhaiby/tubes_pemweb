<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JasaController extends Controller
{
    public function index()
    {
        // Jika ingin kirim data, bisa tambahkan array
        return view('jasa');
    }
}
