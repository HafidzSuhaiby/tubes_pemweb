<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomePenjualController extends Controller
{
    // Menampilkan halaman utama penjual
    public function index()
    {
        return view('home-penjual');
    }
}
