<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifikasi;

class NotifikasiController extends Controller
{
    public function index()
    {
        // Pastikan user terautentikasi
        if(auth()->check()) {
            $notifikasis = [
                [
                    'judul' => 'Persetujuan Diterima',
                    'konten' => 'Terima kasih, goktahyt@gmail.com! Mobil Toyota Alphard telah dipesan untuk tanggal [05/05/2025-06/05/2025].',
                    'tanggal' => '05 Mei 2025'
                ],
                [
                    'judul' => 'Pengingat Pengembalian',
                    'konten' => 'Mobil Toyota Alphard harus dikembalikan sebelum pukul 17.00 hari ini. Keterlambatan dikenakan biaya tambahan.',
                    'tanggal' => '06 Mei 2025'
                ]
            ];

            return view('notifikasi', compact('notifikasis'));
        }

        return redirect('/login');
    }
}