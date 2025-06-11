<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController; 
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DatadiriController;
use App\Http\Controllers\KonfirmasiController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\PesananAdminController;
use App\Http\Controllers\DaftarMobilAdminController;
use App\Http\Controllers\LaporanController;
// routes/web.php


// Route untuk Admin Dashboard
Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/dashboardadmin', function () {
        return view('dashboardadmin');  // Nama blade untuk admin
    })->name('dashboardadmin');
});

// Route untuk Dashboard Pelanggan
Route::group(['middleware' => ['auth', 'customer']], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');  // Mengarah ke file resources/views/dashboard.blade.php
    })->name('dashboard');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->name('home');

Route::get('/riwayat', function () {
    return view('riwayat');
})->name('riwayat');
// Route untuk menampilkan halaman login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Route untuk menampilkan halaman registrasi
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');

// Route untuk proses login Admin
Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login.submit');


// Route untuk proses login Pelanggan
Route::post('/pelanggan/login', [AuthController::class, 'pelangganLogin'])->name('pelanggan.login.submit');

// Route untuk menangani submit form login umum
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Route untuk registrasi Admin
Route::get('/admin/register', [AuthController::class, 'showAdminRegisterForm'])->name('admin.register');
Route::post('/admin/register', [AuthController::class, 'adminRegister'])->name('admin.register.submit');

// Route untuk registrasi Pelanggan
Route::get('/pelanggan/register', [AuthController::class, 'showPelangganRegisterForm'])->name('pelanggan.register');
Route::post('/pelanggan/register', [AuthController::class, 'pelangganRegister'])->name('pelanggan.register.submit');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// Resource untuk Admin dan Pelanggan
Route::resource('pelanggan', PelangganController::class);
Route::resource('admin', AdminController::class);


// Route untuk lupa password (menampilkan form)
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');

// Route untuk mengirimkan email dan langsung menuju halaman reset password
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');

// Route untuk menampilkan halaman reset password
Route::get('/reset-password', [AuthController::class, 'showResetPasswordForm'])->name('password.reset.form');

// Route untuk memproses reset password
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

// dashboard setelah login
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/', function () {
    return view('welcome'); // Ganti dengan view home Anda
})->name('home');




use App\Http\Controllers\MobilController;

Route::resource('mobil', MobilController::class);
Route::post('/mobil/{id}/restore', [MobilController::class, 'restore'])->name('mobil.restore');
Route::delete('/mobil/{id}/force-delete', [MobilController::class, 'forceDelete'])->name('mobil.forceDelete');
Route::resource('mobil', MobilController::class);




Route::resource('kategori', KategoriController::class);

// Setelah reset password berhasil, arahkan pengguna ke halaman login

// ROUTE PADA SIDEBAARRRR DASHBOARD PELANGGAN

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat');
Route::resource('ulasan', UlasanController::class)->only(['index', 'store']);
Route::post('/ulasan', [UlasanController::class, 'store'])->name('ulasans.store');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat');
Route::get('/ulasan', [UlasanController::class, 'index'])->name('ulasan');
Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// routes/web.php



Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
Route::get('/tentangkami', function () {    return view('tentangkami');})->name('tentangkami');
Route::get('/kategori', function () {    return view('kategori');})->name('kategori');
Route::get('/wisata', function () {    return view('wisata');})->name('wisata');

Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
Route::get('/detail/{id}', [MobilController::class, 'show'])->name('detail');


//booking
Route::get('/datadiri/{mobil_id}', [DatadiriController::class, 'showForm'])->name('datadiri.show');


Route::post('/datadiri/store', [DatadiriController::class, 'store'])->name('datadiri.store');


Route::get('/konfirmasi/{pesan}', [KonfirmasiController::class, 'show'])->name('konfirmasi.show');


Route::get('/datadiri/{mobil_id}', [DatadiriController::class, 'showForm'])->name('datadiri.create');
Route::post('/datadiri/store', [DatadiriController::class, 'store'])->name('datadiri.store');


Route::get('/booking/{mobil_id}', [DatadiriController::class, 'showForm'])->name('booking.create');
Route::post('/booking/store', [DatadiriController::class, 'store'])->name('booking.store');



Route::get('/dashboardadmin', [AdminDashboardController::class, 'index'])->name('dashboardadmin');
Route::get('/pesananadmin', [PesananAdminController::class, 'index'])->name('pesananadmin');
Route::get('/daftarmobiladmin', [DaftarMobilAdminController::class, 'index'])->name('daftarmobiladmin');;
Route::get('/laporanadmin', [LaporanController::class, 'index'])->name('laporanadmin');


Route::middleware('auth')->group(function () {
    Route::get('/booking/form', [PesanController::class, 'create'])->name('booking.form');
    //Route::post('/datadiri/store', [PesanController::class, 'store'])->name('datadiri.store');
    
    Route::get('/konfirmasipesanan/{pesan}', [PesanController::class, 'konfirmasi'])->name('konfirmasipesanan');
    Route::post('/pembayaran/store/{pesan}', [PesanController::class, 'pembayaranStore'])->name('pembayaran.store');
    Route::get('/pembayaran/proses/{pesan}', function () {
        return view('pembayaran'); // Ganti dengan view pembayaran
    })->name('pembayaran.proses');
});

//Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/pesanan', [PesananAdminController::class, 'index'])->name('pesananadmin.index');
    Route::post('/admin/pesanan/{pesan}/verify', [PesananAdminController::class, 'verify'])->name('pesananadmin.verify');
    Route::get('/admin/pesanan/download/{file}', [PesananAdminController::class, 'download'])->name('pesananadmin.download');
    Route::get('/admin/pesanan/download/{file}', [PesananAdminController::class, 'download'])
    ->where('file', '.*')  // wildcard supaya menangkap folder dan nama file dengan slash
    ->name('pesananadmin.download');
//});
