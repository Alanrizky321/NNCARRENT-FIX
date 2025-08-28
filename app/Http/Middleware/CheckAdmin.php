<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
 public function handle(Request $request, Closure $next)
{
    Log::info('CheckAdmin Middleware - Auth Status: ' . Auth::guard('admin')->check());
    Log::info('CheckAdmin Middleware - Session ID: ' . session()->getId());
    Log::info('CheckAdmin Middleware - User ID: ' . (Auth::guard('admin')->check() ? Auth::guard('admin')->id() : 'null'));
    if (Auth::guard('admin')->check()) {
        return $next($request);
    }
    return redirect()->route('admin.login')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
}
    
}