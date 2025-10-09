<?php

// app/Http/Controllers/HomeController.php
namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\ratingUlasan;

class HomeController extends Controller
{
    public function index()
    {
        $mobils = Mobil::all()->take(6); // Ambil 6 mobil teratas
        $dataRating = ratingUlasan::latest()->get();
        $medianRating = ratingUlasan::avg('rating');
        $starnow = floor($medianRating);
        $emptystar = 5 - $starnow;
        return view('welcome', compact([
            'mobils',
            'dataRating',
            'medianRating',
            'starnow',
            'emptystar'
        ]));
    }

    public function tentangkami()
    {
        return view('tentangkami'); // Buat view terpisah jika diperlukan
    }

    public function kategori()
    {
        $mobils = Mobil::all(); // Ambil semua mobil untuk daftar
        return view('kategori', compact('mobils'));
    }
}
