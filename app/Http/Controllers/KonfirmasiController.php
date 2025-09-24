<?php

namespace App\Http\Controllers;

use App\Models\Pesan;

class KonfirmasiController extends Controller
{
    public function show($pesanId)
    {
        $pesan = Pesan::with('mobil')->findOrFail($pesanId);

        // Hitung durasi sewa
        $mulai = new \DateTime($pesan->tanggal_mulai);
        $selesai = new \DateTime($pesan->tanggal_selesai);
        $interval = $mulai->diff($selesai);
        $durasi = $interval->days ;

        $totalHarga = $durasi * $pesan->mobil->Harga_Sewa;

        return view('konfirmasipesanan', compact('pesan', 'durasi', 'totalHarga'));
    }
}
