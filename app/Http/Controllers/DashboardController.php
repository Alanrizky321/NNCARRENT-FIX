<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mobil; // Tambahkan import model Mobil
use App\Models\ratingUlasan;

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
        $dataRating = ratingUlasan::latest()->get();
        $medianRating = ratingUlasan::avg('rating');
        $starnow = floor($medianRating);
        $emptystar = 5 - $starnow;
        return view('welcome', compact([
            'mobils',
            'dataRating',
            'medianRating',
            'starnow',
            'emptystar',
        ]));
    }
}
