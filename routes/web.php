<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

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

// Di bawah Auth::routes() atau di tempat yang sesuai
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')
     ->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')
     ->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')
     ->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')
     ->name('password.update');
     
Route::get('/', function () {
    return view('welcome'); // Ganti dengan view home Anda
})->name('home');


