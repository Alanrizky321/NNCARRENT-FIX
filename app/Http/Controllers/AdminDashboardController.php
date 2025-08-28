<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use App\Models\Mobil;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Ambil data yang dibutuhkan untuk dashboard
        $pesansCount = Pesan::count();  // Total pesanan
        $mobilsCount = Mobil::count();  // Total mobil terdaftar
        $pesans = Pesan::with('mobil')->take(3)->get(); // Ambil 3 pesanan teratas dengan relasi mobil

        // Kirim data ke view dashboard
        return view('dashboardadmin', compact('pesansCount', 'mobilsCount', 'pesans'));
    }
}