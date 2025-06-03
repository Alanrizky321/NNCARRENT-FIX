<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        // Jika ada data laporan dari database, bisa dikirim ke view di sini
        return view('laporanadmin');
    }
}

