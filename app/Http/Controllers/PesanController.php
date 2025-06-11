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
        // Pastikan data mobil dikirim ke view jika diperlukan
        // Contoh: $mobil = Mobil::find($request->input('mobil_id'));
        return view('datadiri');
    }

    public function store(Request $request)
    {
        try {
            // Periksa apakah pengguna terautentikasi
            $user = Auth::user();
            if (!$user) {
                Log::error('User not authenticated');
                return redirect()->route('login')->withErrors(['error' => 'Silakan login terlebih dahulu.']);
            }

            // Log input untuk debugging
            Log::debug('Input data', $request->all());

            // Validasi input
            $validated = $request->validate([
                'mobil_id' => 'required|exists:mobils,ID_Mobil', // Sesuai migrasi
                'customer_name' => 'required|string|max:255',
                'phone_number' => [
                    'required',
                    'string',
                    'max:15',
                    function ($attribute, $value, $fail) use ($user) {
                        if (!$user->phone_number) {
                            $fail('Akun Anda belum memiliki nomor telepon. Silakan perbarui profil.');
                        }
                        $normalizedInput = preg_replace('/[\s-+]/', '', $value);
                        $normalizedUser = preg_replace('/[\s-+]/', '', $user->phone_number);
                        if ($normalizedInput !== $normalizedUser) {
                            $fail('Nomor telepon harus sesuai dengan akun Anda.');
                        }
                    },
                ],
                'email' => [
                    'required',
                    'email',
                    'max:255',
                    function ($attribute, $value, $fail) use ($user) {
                        if ($value !== $user->email) {
                            $fail('Email harus sesuai dengan akun Anda.');
                        }
                    },
                ],
                'rental_date' => [
                    'required',
                    'date',
                    'after_or_equal:' . now()->setTimezone('Asia/Jakarta')->addDays(2)->toDateString(),
                ],
                'return_date' => [
                    'required',
                    'date',
                    'after:rental_date',
                ],
                'ktp_photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
                'sim_photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            Log::debug('Validated data', $validated);

            // Periksa apakah disk private tersedia
          

            // Simpan file KTP dan SIM
            $ktpPath = $request->file('ktp_photo')->store('ktp_photos', 'private');
            $simPath = $request->file('sim_photo')->store('sim_photos', 'private');

            // Buat record Pesan
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
            return redirect()->back()->withErrors(['error' => 'Gagal memuat halaman konfirmasi.']);
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
}