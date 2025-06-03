<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Gunakan guard 'web' dan pastikan menggunakan model 'Admin'
        if (Auth::guard('web')->check() && Auth::guard('web')->user()->role == 'admin') {
            return $next($request);  // Akses admin berhasil
        }

        // Jika bukan admin, alihkan ke login
        return redirect('/login')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}
