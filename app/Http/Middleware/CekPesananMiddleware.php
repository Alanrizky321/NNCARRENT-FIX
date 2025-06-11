<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CekPesananMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Jika pengguna sudah melakukan pemesanan (status terkonfirmasi)
        if (session('pesanan_terkonfirmasi')) {
            // Redirect ke halaman kategori atau halaman lain
            return redirect()->route('kategori');
        }

        // Lanjutkan ke halaman data diri jika pesanan belum terkonfirmasi
        return $next($request);
    }
}
