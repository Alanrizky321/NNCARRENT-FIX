<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PesanController extends Controller
{
    public function create()
    {
        return view('datadiri');
    }

    public function store(Request $request)
    {
        try {
            $user = Auth::guard('pelanggan')->user();
            if (!$user) {
                return redirect()->route('pelanggan.login')->withErrors(['error' => 'Silakan login terlebih dahulu.']);
            }

            $validated = $request->validate([
                'mobil_id' => 'required|exists:mobils,ID_Mobil',
                'customer_name' => 'required|string|max:255',
                'phone_number' => 'required|string|max:15',
                'email' => 'required|email|max:255',
                'rental_date' => 'required|date|after_or_equal:' . now()->addDays(2)->toDateString(),
                'return_date' => 'required|date|after:rental_date',
                'ktp_photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
                'sim_photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
                'total_harga' => 'required|numeric|min:0',
            ]);

            $ktpPath = $request->file('ktp_photo')->store('ktp_photos', 'public');
            $simPath = $request->file('sim_photo')->store('sim_photos', 'public');

            $pesan = Pesan::create([
                'user_id' => $user->id,
                'mobil_id' => $validated['mobil_id'],
                'nama_pelanggan' => $validated['customer_name'],
                'nomor_hp' => $validated['phone_number'],
                'email' => $validated['email'],
                'tanggal_mulai' => $validated['rental_date'],
                'tanggal_selesai' => $validated['return_date'],
                'ktp_photo_path' => $ktpPath,
                'sim_photo_path' => $simPath,
                'verification_status' => 'pending',
                'status' => 'pending',
                'total_harga' => $validated['total_harga'],
            ]);

            Log::info('Pesan created', ['pesan_id' => $pesan->id, 'user_id' => $user->id]);
            return redirect()->route('konfirmasipesanan', $pesan->id)->with('success', 'Pemesanan berhasil! Menunggu verifikasi dokumen.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed: ' . $e->getMessage(), ['errors' => $e->errors()]);
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Illuminate\Database\QueryException $e) {
            Log::error('Database error: ' . $e->getMessage(), ['exception' => $e]);
            return redirect()->back()->withErrors(['error' => 'Gagal menyimpan data ke database. Silakan coba lagi.']);
        } catch (\Exception $e) {
            Log::error('Unexpected error: ' . $e->getMessage(), ['exception' => $e]);
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function konfirmasi(Pesan $pesan)
    {
        try {
            $durasi = (strtotime($pesan->tanggal_selesai) - strtotime($pesan->tanggal_mulai)) / (60 * 60 * 24);
            return view('konfirmasipesanan', compact('pesan', 'durasi'));
        } catch (\Exception $e) {
            Log::error('Konfirmasi error: ' . $e->getMessage(), ['exception' => $e]);
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function pembayaranStore(Request $request, Pesan $pesan)
    {
        try {
            $validated = $request->validate([
                'antar_jemput' => 'required|in:antar-jemput,ambil-garasi',
                'lokasi_antar' => 'required_if:antar_jemput,antar-jemput|string|max:255|nullable',
                'lokasi_jemput' => 'required_if:antar_jemput,antar-jemput|string|max:255|nullable',
            ]);

            $pesan->update([
                'antar_jemput' => $validated['antar_jemput'],
                'lokasi_antar' => $validated['lokasi_antar'],
                'lokasi_jemput' => $validated['lokasi_jemput'],
            ]);

            Log::info('Konfirmasi updated', ['pesan_id' => $pesan->id]);
            return redirect()->route('pembayaran.proses', $pesan->id)->with('success', 'Data konfirmasi disimpan. Lanjut ke pembayaran.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed in pembayaranStore: ' . $e->getMessage(), ['errors' => $e->errors()]);
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Pembayaran store error: ' . $e->getMessage(), ['exception' => $e]);
            return redirect()->back()->withErrors(['error' => 'Gagal menyimpan data konfirmasi: ' . $e->getMessage()]);
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
            return redirect()->back()->with('error', 'Tanggal baru tidak tersedia untuk mobil ini.');
        }

        $pesan->update([
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => 'pending',
        ]);

        Log::info('Reschedule submitted', ['pesan_id' => $id, 'status' => $pesan->status, 'tanggal_mulai' => $pesan->tanggal_mulai, 'tanggal_selesai' => $pesan->tanggal_selesai]);

        return redirect()->route('riwayat')->with('success', 'Permintaan reschedule telah dikirim dan menunggu persetujuan admin. Status pesanan kini pending.');
    }
}
