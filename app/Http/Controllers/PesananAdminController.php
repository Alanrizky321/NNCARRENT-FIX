<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PesananAdminController extends Controller
{
    public function index()
    {
        $pesans = Pesan::with('mobil')->get();
        return view('pesananadmin', compact('pesans'));
    }

    public function download($file)
    {
        $filePath = storage_path('app/public/' . $file);
        if (!file_exists($filePath)) {
            abort(404, 'File not found.');
        }
        return response()->download($filePath);
    }

    public function verify(Request $request, $pesanId)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
            'rejection_reason' => 'nullable|string|max:255',
        ]);
        $pesan = Pesan::findOrFail($pesanId);

        if ($request->input('status') === 'approved') {
            $pesan->verification_status = 'approved';
            $pesan->status = 'on_going';
            $pesan->rejection_reason = null;
        } else {
            $pesan->verification_status = 'rejected';
            $pesan->status = 'canceled';
            $pesan->rejection_reason = $request->input('rejection_reason');
        }

        $pesan->save();
        return redirect()->route('pesananadmin')->with('success', 'Status verifikasi berhasil diperbarui.');
    }

    public function approveReschedule($id)
    {
        $pesan = Pesan::findOrFail($id);
        if ($pesan->status !== 'pending') {
            return redirect()->route('pesananadmin')->with('error', 'Pesanan tidak dalam status pending untuk reschedule.');
        }

        // Tidak perlu rollback tanggal, karena tanggal sudah diupdate di reschedule
        $pesan->update([
            'status' => 'on_going',
        ]);

        Log::info('Reschedule approved', ['pesan_id' => $pesan->id, 'status' => $pesan->status]);
        return redirect()->route('pesananadmin')->with('success', 'Permintaan reschedule disetujui. Status pesanan kini on_going.');
    }

    public function rejectReschedule(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'nullable|string|max:255',
        ]);

        $pesan = Pesan::findOrFail($id);
        if ($pesan->status !== 'pending') {
            return redirect()->route('pesananadmin')->with('error', 'Pesanan tidak dalam status pending untuk reschedule.');
        }

        // Kembali ke tanggal semula (simpan tanggal lama sebelum update)
        $oldStart = $pesan->getOriginal('tanggal_mulai');
        $oldEnd = $pesan->getOriginal('tanggal_selesai');

        $pesan->update([
            'status' => 'on_going',
            'tanggal_mulai' => $oldStart,
            'tanggal_selesai' => $oldEnd,
            'rejection_reason' => $request->input('rejection_reason'),
        ]);

        Log::info('Reschedule rejected', ['pesan_id' => $pesan->id, 'status' => $pesan->status, 'tanggal_mulai' => $pesan->tanggal_mulai, 'tanggal_selesai' => $pesan->tanggal_selesai]);
        return redirect()->route('pesananadmin')->with('success', 'Permintaan reschedule ditolak. Tanggal dikembalikan ke semula.');
    }
}