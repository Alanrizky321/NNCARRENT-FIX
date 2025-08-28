<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckCustomer
{
public function handle(Request $request, Closure $next)
{
    Log::info('CheckCustomer Middleware - Auth Status: ' . Auth::guard('pelanggan')->check());
    Log::info('CheckCustomer Middleware - Session ID: ' . session()->getId());
    Log::info('CheckCustomer Middleware - User ID: ' . (Auth::guard('pelanggan')->check() ? Auth::guard('pelanggan')->id() : 'null'));
    if (Auth::guard('pelanggan')->check()) {
        return $next($request);
    }
    return redirect()->route('pelanggan.login')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
}
}