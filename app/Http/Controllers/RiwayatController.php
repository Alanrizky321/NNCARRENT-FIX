<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pesan;
use Illuminate\Support\Facades\Log;

class RiwayatController extends Controller
{
    public function index()
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return redirect()->route('login')
                    ->withErrors(['error' => 'Silakan login terlebih dahulu.']);
            }

            // Ambil semua pesanan milik user login + relasi mobil
            $pesanan = Pesan::with('mobil')
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();

            return view('riwayat', compact('pesanan')); // ✅ ini sesuai blade kamu
        } catch (\Exception $e) {
            Log::error('Gagal memuat riwayat: ' . $e->getMessage(), ['exception' => $e]);
            return redirect()->back()->withErrors(['error' => 'Gagal memuat riwayat pemesanan.']);
        }
    }
    public function reschedule($id)
{
    $pesanan = Pesan::findOrFail($id);
    return view('reschedule', compact('pesanan'));
}

public function updateReschedule(Request $request, $id)
{
    $request->validate([
        'tanggal_mulai' => 'required|date|after_or_equal:today',
        'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
    ]);

    $pesanan = Pesan::findOrFail($id);
    $pesanan->update([
        'tanggal_mulai' => $request->tanggal_mulai,
        'tanggal_selesai' => $request->tanggal_selesai,
    ]);

    return redirect()->route('riwayat')->with('success', 'Jadwal berhasil diubah.');
}

}
