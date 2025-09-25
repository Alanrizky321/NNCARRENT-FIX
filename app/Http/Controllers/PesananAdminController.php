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
        \Log::info('Pesanan:', $pesans->toArray()); // Debug ke log
        return view('pesananadmin', compact('pesans'));
    }

   public function verify(Request $request, $id)
{
    $request->validate([
        'action' => 'required|in:verify,cancel', // Membedakan aksi
        'status' => 'required_if:action,verify|in:approved,rejected', // Wajib untuk verifikasi
        'rejection_reason' => 'nullable|string|max:255', // Opsional untuk penolakan
        'cancellation_reason' => 'nullable|string|max:255', // Opsional untuk pembatalan
    ]);

    $pesan = Pesan::findOrFail($id);

    if ($request->input('action') === 'verify') {
        // Logika verifikasi (status: pending)
        if ($pesan->status !== 'pending') {
            return redirect()->route('pesananadmin')->with('error', 'Pesanan tidak dalam status pending untuk diverifikasi.');
        }

        $status = $request->input('status') === 'approved' ? 'on_going' : 'canceled';
        $pesan->update([
            'status' => $status,
            'verification_status' => $request->input('status'),
            'rejection_reason' => $request->input('rejection_reason'),
        ]);

        Log::info('Pesanan diverifikasi', [
            'pesan_id' => $pesan->id,
            'status' => $pesan->status,
            'verification_status' => $pesan->verification_status,
        ]);
    } elseif ($request->input('action') === 'cancel') {
        // Logika pembatalan (status: on_going)
        if ($pesan->status !== 'on_going') {
            return redirect()->route('pesananadmin')->with('error', 'Pesanan tidak dalam status on_going untuk dibatalkan.');
        }

        $pesan->update([
            'status' => 'canceled',
            'cancellation_reason' => $request->input('cancellation_reason'),
        ]);

        Log::info('Pesanan dibatalkan', [
            'pesan_id' => $pesan->id,
            'status' => $pesan->status,
            'cancellation_reason' => $pesan->cancellation_reason,
        ]);
    }

    return redirect()->route('pesananadmin')->with('success', $request->input('action') === 'verify' ? 'Pesanan berhasil diverifikasi.' : 'Pesanan berhasil dibatalkan.');
}

    

    public function download($file)
    {
        $filePath = storage_path('app/public/' . $file);
        if (file_exists($filePath)) {
            return response()->download($filePath);
        }
        return redirect()->back()->with('error', 'File tidak ditemukan.');
    }

    public function approveReschedule(Request $request, $id)
    {
        $pesan = Pesan::findOrFail($id);
        if (empty($pesan->reschedule_request)) {
            return redirect()->route('pesananadmin')->with('error', 'Tidak ada permintaan reschedule untuk pesanan ini.');
        }

        $pesan->update([
            'tanggal_mulai' => $pesan->reschedule_request['tanggal_mulai'],
            'tanggal_selesai' => $pesan->reschedule_request['tanggal_selesai'],
            'reschedule_request' => null,
        ]);

        Log::info('Reschedule disetujui', [
            'pesan_id' => $pesan->id,
            'tanggal_mulai' => $pesan->tanggal_mulai,
            'tanggal_selesai' => $pesan->tanggal_selesai,
        ]);

        return redirect()->route('pesananadmin')->with('success', 'Reschedule pesanan berhasil disetujui.');
    }

    public function rejectReschedule(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'nullable|string|max:255',
        ]);

        $pesan = Pesan::findOrFail($id);
        if (empty($pesan->reschedule_request)) {
            return redirect()->route('pesananadmin')->with('error', 'Tidak ada permintaan reschedule untuk pesanan ini.');
        }

        $pesan->update([
            'reschedule_request' => null,
            'rejection_reason' => $request->input('rejection_reason'),
        ]);

        Log::info('Reschedule ditolak', [
            'pesan_id' => $pesan->id,
            'rejection_reason' => $request->input('rejection_reason'),
        ]);

        return redirect()->route('pesananadmin')->with('success', 'Reschedule pesanan berhasil ditolak.');
    }
}
