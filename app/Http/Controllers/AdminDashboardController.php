<?php
namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Pesan;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Ambil jumlah pesanan
        $totalPesanan = Pesan::count();
        
        // Ambil jumlah mobil
        $totalMobil = Mobil::count();

        // Ambil jumlah pengguna
        $totalUser = User::count();

        // Ambil total pendapatan dan pengeluaran (misalnya, jika ada dalam database)
        $income = Pesan::sum('total_harga'); // Ganti dengan kolom yang sesuai
       

        return view('dashboardadmin', compact('totalPesanan', 'totalMobil', 'totalUser', 'income'));
    }
}
