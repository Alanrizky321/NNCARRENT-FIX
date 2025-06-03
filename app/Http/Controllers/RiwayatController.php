<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index()
    {
        return view('riwayat'); // pastikan file riwayat.blade.php ada di folder resources/views
    }
}