<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckCustomer
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('pelanggan')->check() && Auth::guard('pelanggan')->user()->role == 'customer') {
            return $next($request);
        }

        return redirect('/login')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}
