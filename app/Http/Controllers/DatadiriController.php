<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use App\Models\Mobil;
use Illuminate\Http\Request;

class DatadiriController extends Controller
{
    public function showForm($mobil_id)
    {
        $mobil = Mobil::findOrFail($mobil_id);
        return view('datadiri', compact('mobil'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'mobil_id' => 'required|integer|exists:mobil,ID_Mobil',
            'rental_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:rental_date',
            'ktp_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sim_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bukti_pembayaran' => 'required|file|mimes:jpeg,png,jpg,gif,pdf|max:2048',
            'pickup_method' => 'required|in:ambil-garasi,antar-jemput',
            'lokasi_antar' => 'nullable|string|max:255',
            'lokasi_jemput' => 'nullable|string|max:255',
            'total_bayar' => 'required|numeric|min:0', // Validasi input total_bayar
        ]);

        $ktpPath = $request->file('ktp_photo')->store('ktp_photos', 'public');
        $simPath = $request->file('sim_photo')->store('sim_photos', 'public');
        $buktiPembayaranPath = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

        // Hitung ulang total_harga di server untuk keamanan
        $mobil = Mobil::findOrFail($validated['mobil_id']);
        $hargaSewa = $mobil->Harga_Sewa;
        $biayaAntarJemput = 50000;
        $rentalDate = new \DateTime($validated['rental_date']);
        $returnDate = new \DateTime($validated['return_date']);
        $durasiSewa = max(1, $rentalDate->diff($returnDate)->days);
        $totalHarga = $hargaSewa * $durasiSewa;
        if ($validated['pickup_method'] === 'antar-jemput') {
            $totalHarga += $biayaAntarJemput;
        }

        $pesan = Pesan::create([
            'mobil_id' => $validated['mobil_id'],
            'tanggal_mulai' => $validated['rental_date'],
            'tanggal_selesai' => $validated['return_date'],
            'nama_pelanggan' => $validated['customer_name'],
            'nomor_hp' => $validated['phone_number'],
            'email' => $validated['email'],
            'ktp_photo_path' => $ktpPath,
            'sim_photo_path' => $simPath,
            'bukti_pembayaran_path' => $buktiPembayaranPath,
            'antar_jemput' => $validated['pickup_method'],
            'lokasi_antar' => $validated['lokasi_antar'] ?? null,
            'lokasi_jemput' => $validated['lokasi_jemput'] ?? null,
            'total_harga' => $totalHarga, // Simpan total_harga
        ]);

        return redirect()->route('konfirmasi.show', ['pesan' => $pesan->id])
                         ->with('success', 'Booking successfully created.');
    }
}