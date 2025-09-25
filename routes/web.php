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
use App\Http\Controllers\MobilController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/tentangkami', function () {
    return view('tentangkami');
})->name('tentangkami');

Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');

Route::get('/wisata', function () {
    return view('wisata');
})->name('wisata');

Route::get('/detail/{id}', [MobilController::class, 'show'])->name('detail');

// Autentikasi
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// Lupa Password
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset.form');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'adminLogin'])->name('admin.login.submit');
    Route::post('/logout', [AuthController::class, 'adminLogout'])->name('admin.logout');

    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/dashboardadmin', [AdminDashboardController::class, 'index'])->name('dashboardadmin');
        Route::get('/pesanan', [PesananAdminController::class, 'index'])->name('pesananadmin');
        Route::post('/pesanan/{pesan}/verify', [PesananAdminController::class, 'verify'])->name('pesananadmin.verify');
        Route::get('/pesanan/download/{file}', [PesananAdminController::class, 'download'])
            ->where('file', '.*')
            ->name('pesananadmin.download');
        Route::get('/daftarmobil', [DaftarMobilAdminController::class, 'index'])->name('daftarmobiladmin');
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporanadmin');
        Route::post('/pesanan/{id}/cancel', [PesananAdminController::class, 'cancel'])->name('pesanan.cancel'); // Ganti YourController dengan nama controller Anda
        Route::post('/pesanan/{id}/reschedule/approve', [PesananAdminController::class, 'approveReschedule'])->name('pesananadmin.reschedule.approve');
        Route::post('/pesanan/{id}/reschedule/reject', [PesananAdminController::class, 'rejectReschedule'])->name('pesananadmin.reschedule.reject');
        Route::resource('admin', AdminController::class);
    });
});

/*
|--------------------------------------------------------------------------
| Pelanggan Routes
|--------------------------------------------------------------------------
*/
Route::prefix('pelanggan')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('pelanggan.login');
    Route::post('/login', [AuthController::class, 'pelangganLogin'])->name('pelanggan.login.submit');
    Route::post('/logout', [AuthController::class, 'pelangganLogout'])->name('pelanggan.logout');

    Route::middleware(['auth:pelanggan'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat');
        Route::get('/ulasan', [UlasanController::class, 'index'])->name('ulasan');
        Route::post('/ulasan', [UlasanController::class, 'store'])->name('ulasan.store');
        Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi');
        Route::resource('pelanggan', PelangganController::class);
        Route::get('/detail-pemesanan', [BookingController::class, 'index'])->name('pelanggan.detailPemesanan');
        Route::get('/pesanan/{id}/reschedule', [RiwayatController::class, 'reschedule'])->name('pesanan.reschedule');
        Route::put('/pesanan/{id}/reschedule', [RiwayatController::class, 'updateReschedule'])->name('pesanan.updateReschedule');
        Route::get('/booking/{mobil_id}', [DatadiriController::class, 'showForm'])->name('booking.create');
        Route::post('/booking/store', [DatadiriController::class, 'store'])->name('booking.store');
        Route::get('/datadiri/{mobil_id}', [DatadiriController::class, 'showForm'])->name('datadiri.create');
        Route::post('/datadiri/store', [DatadiriController::class, 'store'])->name('datadiri.store');
        Route::get('/konfirmasi/{pesan}', [KonfirmasiController::class, 'show'])->name('konfirmasi.show');
    });
});

/*
|--------------------------------------------------------------------------
| General Protected Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/booking/form', [PesanController::class, 'create'])->name('booking.form');
    Route::get('/konfirmasipesanan/{pesan}', [PesanController::class, 'konfirmasi'])->name('konfirmasipesanan');
    Route::post('/pembayaran/store/{pesan}', [PesanController::class, 'pembayaranStore'])->name('pembayaran.store');
    Route::get('/pembayaran/proses/{pesan}', function () {
        return view('pembayaran');
    })->name('pembayaran.proses');
});

/*
|--------------------------------------------------------------------------
| Resource Routes
|--------------------------------------------------------------------------
*/
Route::resource('mobil', MobilController::class);
Route::post('/mobil/{id}/restore', [MobilController::class, 'restore'])->name('mobil.restore');
Route::delete('/mobil/{id}/force-delete', [MobilController::class, 'forceDelete'])->name('mobil.forceDelete');

Route::prefix('laporan')->group(function () {
    Route::get('/', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/baru', [LaporanController::class, 'create'])->name('laporan.baru');
    Route::post('/', [LaporanController::class, 'store'])->name('laporan.store');
    Route::get('/{id}', [LaporanController::class, 'show'])->name('laporan.show');
    Route::delete('/{id}', [LaporanController::class, 'destroy'])->name('laporan.destroy');
});