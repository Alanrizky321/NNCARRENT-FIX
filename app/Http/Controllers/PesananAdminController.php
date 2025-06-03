<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use Illuminate\Http\Request;

class PesananAdminController extends Controller
{
    public function index()
    {
        // Ambil semua pesanan beserta relasi mobil-nya untuk efisiensi query
        $pesans = Pesan::with('mobil')->get();

        // Kirim data pesans ke view 'pesananadmin'
        return view('pesananadmin', compact('pesans'));
    }

    // Fungsi untuk download file (KTP, SIM, Bukti Pembayaran)
    public function download($file)
    {
        $filePath = storage_path('app/public/' . $file);

        if (!file_exists($filePath)) {
            abort(404, 'File not found.');
        }

        return response()->download($filePath);
    }

    // Fungsi untuk update verifikasi status pesanan
    public function verify(Request $request, $pesanId)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
            'rejection_reason' => 'nullable|string|max:255',
        ]);

        $pesan = Pesan::findOrFail($pesanId);

        // Update verification_status dan juga status pesanan
        if ($request->input('status') === 'approved') {
            $pesan->verification_status = 'approved';
            $pesan->status = 'on_going';        // Update status jadi on_going jika disetujui
            $pesan->rejection_reason = null;
        } else {
            $pesan->verification_status = 'rejected';
            $pesan->status = 'canceled';        // Update status jadi canceled jika ditolak
            $pesan->rejection_reason = $request->input('rejection_reason');
        }

        $pesan->save();

        return redirect()->route('pesananadmin')->with('success', 'Status verifikasi berhasil diperbarui.');
    }
}
