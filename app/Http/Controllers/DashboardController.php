<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mobil; // Tambahkan import model Mobil

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data mobil dari database dengan relasi kategori
        $mobils = Mobil::with('kategori')
                       ->where('Status_Ketersediaan', 1) // Opsional: hanya tampilkan mobil yang tersedia
                       ->latest() // Urutkan dari yang terbaru
                       ->take(10) // Ambil 10 mobil untuk slider
                       ->get();
        
        // Kirim data ke view
        return view('dashboard', compact('mobils'));
    }
}