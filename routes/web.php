<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

// Route untuk menampilkan halaman login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Route untuk proses login Admin
Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login.submit');

// Route untuk menangani submit form login
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Route untuk proses login Pelanggan
Route::post('/pelanggan/login', [AuthController::class, 'pelangganLogin'])->name('pelanggan.login.submit');


Route::resource('pelanggan', PelangganController::class);
Route::resource('admin', AdminController::class);
Route::get('/', function () {
    return view('welcome');
});
