<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UlasanController extends Controller
{
    // Menampilkan halaman ulasan
    public function index()
    {
        // Menggunakan data statis (hardcoded) untuk ulasan
        $reviews = [
            (object)[
                'car_model' => 'Toyota Alphard',
                'rating' => 5,
                'comment' => 'Sangat puas dengan layanannya! Mobil datang tepat waktu dan dalam kondisi bersih.',
                'user' => (object)[ 'name' => 'John Doe' ] // Simulasikan data pengguna
            ],
            (object)[
                'car_model' => 'Toyota Avanza',
                'rating' => 4,
                'comment' => 'Layanan oke, hanya sedikit keterlambatan pengantaran.',
                'user' => (object)[ 'name' => 'Jane Smith' ] // Simulasikan data pengguna
            ],
        ];

        return view('ulasan', [
            'reviews' => $reviews
        ]);
    }

    // Menyimpan ulasan baru (Tetap bisa diproses, meskipun data tidak disimpan ke database)
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'rating' => 'required|integer|between:1,5',
            'comment' => 'required|string|max:500',
            'car_model' => 'required|string' // Tambahkan field yang diperlukan
        ]);

        // Di sini, kita tidak perlu menyimpan data ke database, cukup melakukan sesuatu, misalnya menyimpan di session atau mengirimkan ke admin
        // Contoh, kita akan menyimpan ulasan dalam session untuk sementara
        session()->flash('success', 'Ulasan berhasil dikirim!');
        session()->flash('latest_review', $validated); // Menyimpan ulasan terbaru di session

        return back();
    }
}
