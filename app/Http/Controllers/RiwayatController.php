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
    $pesan = Pesan::findOrFail($id);

    // Cek apakah status bukan canceled
    if ($pesan->status === 'canceled') {
        return redirect()->route('riwayat')->with('error', 'Pesanan sudah dibatalkan, tidak bisa di-reschedule.');
    }

    // Validasi input
    $request->validate([
        'tanggal_mulai' => 'required|date|after_or_equal:today',
        'tanggal_selesai' => [
            'required',
            'date',
            function ($attribute, $value, $fail) use ($request) {
                $startDate = strtotime($request->tanggal_mulai);
                $endDate = strtotime($value);
                $diff = ($endDate - $startDate) / (60 * 60 * 24);
                if ($diff < 1) {
                    $fail('Tanggal selesai harus minimal 1 hari setelah tanggal mulai.');
                }
            },
        ],
    ]);

    // Cek bentrokan jadwal
    $bentrok = Pesan::where('mobil_id', $pesan->mobil_id)
        ->where('status', '!=', 'canceled')
        ->where(function ($query) use ($request) {
            $query->whereBetween('tanggal_mulai', [$request->tanggal_mulai, $request->tanggal_selesai])
                  ->orWhereBetween('tanggal_selesai', [$request->tanggal_mulai, $request->tanggal_selesai])
                  ->orWhere(function ($q) use ($request) {
                      $q->where('tanggal_mulai', '<=', $request->tanggal_mulai)
                        ->where('tanggal_selesai', '>=', $request->tanggal_selesai);
                  });
        })
        ->where('id', '!=', $pesan->id)
        ->exists();

    if ($bentrok) {
        return redirect()->back()->with('error', 'Maaf untuk tanggal pilihan saat ini unit sudah tidak tersedia.');
    }

    // Update data pesanan
    $pesan->update([
        'tanggal_mulai' => $request->tanggal_mulai,
        'tanggal_selesai' => $request->tanggal_selesai,
        'status' => 'pending', // Ubah status menjadi pending setelah reschedule
    ]);

    Log::info('Reschedule submitted', [
        'pesan_id' => $id,
        'status' => $pesan->status,
        'tanggal_mulai' => $pesan->tanggal_mulai,
        'tanggal_selesai' => $pesan->tanggal_selesai
    ]);

    return redirect()->route('riwayat')->with('success', 'Permintaan reschedule telah dikirim dan menunggu persetujuan admin. Status pesanan kini pending.');
}
}