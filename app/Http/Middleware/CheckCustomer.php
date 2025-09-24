<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckCustomer
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('pelanggan')->check()) {
            return $next($request);
        }

        return redirect()->route('pelanggan.login')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}
