<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;

class LaporanController extends Controller
{
    // Menampilkan daftar laporan
    public function index()
    {
        $laporans = Laporan::orderBy('tanggal_laporan', 'desc')->paginate(10);

        // Hitung ringkasan bulanan
        $totalPendapatan = Laporan::whereMonth('tanggal_laporan', now()->month)->sum('total');
        $jumlahTransaksi = Laporan::whereMonth('tanggal_laporan', now()->month)->count();
        $rataRataPerHari = $jumlahTransaksi > 0 ? $totalPendapatan / now()->daysInMonth : 0;

        return view('laporanadmin', compact('laporans', 'totalPendapatan', 'jumlahTransaksi', 'rataRataPerHari'));
    }

    // Menampilkan satu laporan (opsional jika ingin fitur detail)
    public function show($id)
    {
        $laporan = Laporan::findOrFail($id);
        return view('show', compact('laporan'));
    }

    // Hapus laporan
    public function destroy($id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->delete();
        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dihapus.');
    }

    // Menampilkan form input laporan baru
    public function create()
    {
        return view('laporanbaru');
    }

    // Menyimpan laporan baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jenis' => 'required|string',
            'total' => 'required|numeric',
            'deskripsi' => 'nullable|string', // validasi deskripsi
        ]);

        Laporan::create([
            'tanggal_laporan' => $request->tanggal,
            'jenis_laporan' => $request->jenis,
            'total' => $request->total,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dibuat.');
    }
}
