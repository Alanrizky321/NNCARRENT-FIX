<?php

// app/Http/Controllers/HomeController.php
namespace App\Http\Controllers;

use App\Models\Mobil;

class HomeController extends Controller
{
    public function index()
    {
        $mobils = Mobil::all()->take(6); // Ambil 6 mobil teratas
        return view('welcome', compact('mobils'));
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