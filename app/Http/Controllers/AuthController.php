<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use App\Models\Pelanggan;
use App\Models\Admin;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login untuk admin atau pelanggan
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        try {
            if (Admin::where('email', $request->email)->exists()) {
                if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
                    $request->session()->regenerate();
                    $request->session()->put('auth_guard', 'admin');
                    Log::info('Admin Login - Session ID: ' . session()->getId());
                    Log::info('Admin Login - User ID: ' . Auth::guard('admin')->id());
                    Log::info('Admin Login - User Email: ' . Auth::guard('admin')->user()->email);
                    return redirect()->route('dashboardadmin')->with('success', 'Login Admin berhasil!');
                }
            } elseif (Pelanggan::where('email', $request->email)->exists()) {
                if (Auth::guard('pelanggan')->attempt(['email' => $request->email, 'password' => $request->password])) {
                    $request->session()->regenerate();
                    $request->session()->put('auth_guard', 'pelanggan');
                    Log::info('Pelanggan Login - Session ID: ' . session()->getId());
                    Log::info('Pelanggan Login - User ID: ' . Auth::guard('pelanggan')->id());
                    Log::info('Pelanggan Login - User Email: ' . Auth::guard('pelanggan')->user()->email);
                    return redirect()->route('dashboard')->with('success', 'Login Pelanggan berhasil!');
                }
            }

            Log::info('Login gagal untuk email: ' . $request->email);
            return back()->withErrors([
                'email' => 'Email atau password salah.',
            ])->withInput();
        } catch (\Exception $e) {
            Log::error('Login error: ' . $e->getMessage());
            return back()->withErrors([
                'email' => 'Terjadi kesalahan, coba lagi nanti.',
            ])->withInput();
        }
    }

    // Proses login admin
    public function adminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        try {
            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
                $request->session()->regenerate();
                $request->session()->put('auth_guard', 'admin');
                Log::info('Admin Login (adminLogin) - Session ID: ' . session()->getId());
                Log::info('Admin Login (adminLogin) - User ID: ' . Auth::guard('admin')->id());
                Log::info('Admin Login (adminLogin) - User Email: ' . Auth::guard('admin')->user()->email);
                return redirect()->route('dashboardadmin')->with('success', 'Login Admin berhasil!');
            }
            Log::info('Admin login gagal untuk email: ' . $request->email);
            return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
        } catch (\Exception $e) {
            Log::error('Admin login error: ' . $e->getMessage());
            return back()->withErrors(['email' => 'Terjadi kesalahan, coba lagi nanti.'])->withInput();
        }
    }

    // Proses login pelanggan
    public function pelangganLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        try {
            if (Auth::guard('pelanggan')->attempt(['email' => $request->email, 'password' => $request->password])) {
                $request->session()->regenerate();
                $request->session()->put('auth_guard', 'pelanggan');
                Log::info('Pelanggan Login (pelangganLogin) - Session ID: ' . session()->getId());
                Log::info('Pelanggan Login (pelangganLogin) - User ID: ' . Auth::guard('pelanggan')->id());
                Log::info('Pelanggan Login (pelangganLogin) - User Email: ' . Auth::guard('pelanggan')->user()->email);
                return redirect()->route('dashboard')->with('success', 'Login Pelanggan berhasil!');
            }
            Log::info('Pelanggan login gagal untuk email: ' . $request->email);
            return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
        } catch (\Exception $e) {
            Log::error('Pelanggan login error: ' . $e->getMessage());
            return back()->withErrors(['email' => 'Terjadi kesalahan, coba lagi nanti.'])->withInput();
        }
    }

    // Menampilkan form registrasi
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Proses registrasi pelanggan
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:pelanggan,email',
            'no_hp' => 'required|string|max:13',
            'password' => 'required|min:6|confirmed',
        ]);

        try {
            $pelanggan = Pelanggan::create([
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'password' => Hash::make($request->password),
            ]);

            Log::info('Registrasi pelanggan berhasil untuk email: ' . $request->email);
            return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
        } catch (\Exception $e) {
            Log::error('Registrasi error: ' . $e->getMessage());
            return back()->withErrors(['email' => 'Terjadi kesalahan saat registrasi. Coba lagi nanti.'])->withInput();
        }
    }

    // Logout admin
    public function adminLogout(Request $request)
    {
        Log::info('Admin Logout - Session ID sebelum logout: ' . session()->getId());
        Auth::guard('admin')->logout();
        $request->session()->forget('auth_guard');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Log::info('Admin Logout - Session ID setelah logout: ' . session()->getId());
        return redirect()->route('login')->with('success', 'Anda telah logout.');
    }

    // Logout pelanggan
    public function pelangganLogout(Request $request)
    {
        Log::info('Pelanggan Logout - Session ID sebelum logout: ' . session()->getId());
        Auth::guard('pelanggan')->logout();
        $request->session()->forget('auth_guard');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Log::info('Pelanggan Logout - Session ID setelah logout: ' . session()->getId());
        return redirect()->route('login')->with('success', 'Anda telah logout.');
    }

    // Logout umum (fallback)
    public function logout(Request $request)
    {
        $guard = $request->session()->get('auth_guard');
        Log::info('Logout umum dipanggil untuk guard: ' . ($guard ?? 'tidak ada'));
        if ($guard === 'admin') {
            return $this->adminLogout($request);
        } elseif ($guard === 'pelanggan') {
            return $this->pelangganLogout($request);
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Anda telah logout.');
    }

    // Menampilkan form untuk reset password
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    // Mengirimkan link reset password
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        try {
            $broker = Admin::where('email', $request->email)->exists() ? 'admins' : 'pelanggan';
            if (!Admin::where('email', $request->email)->exists() && !Pelanggan::where('email', $request->email)->exists()) {
                Log::info('Reset password gagal: Email tidak ditemukan - ' . $request->email);
                return back()->withErrors(['email' => 'Email tidak ditemukan.']);
            }

            $response = Password::broker($broker)->sendResetLink(['email' => $request->email]);
            Log::info('Reset password link dikirim untuk email: ' . $request->email . ' - Status: ' . $response);
            return $response === Password::RESET_LINK_SENT
                ? back()->with('status', trans($response))
                : back()->withErrors(['email' => trans($response)]);
        } catch (\Exception $e) {
            Log::error('Reset password error: ' . $e->getMessage());
            return back()->withErrors(['email' => 'Terjadi kesalahan, coba lagi nanti.']);
        }
    }

    // Menampilkan form reset password
    public function showResetPasswordForm(Request $request, $token = null)
    {
        return view('auth.reset-password', ['token' => $token, 'email' => $request->email]);
    }

    // Proses reset password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
            'token' => 'required',
        ]);

        try {
            $broker = Admin::where('email', $request->email)->exists() ? 'admins' : 'pelanggan';
            if (!Admin::where('email', $request->email)->exists() && !Pelanggan::where('email', $request->email)->exists()) {
                Log::info('Reset password gagal: Email tidak ditemukan - ' . $request->email);
                return back()->withErrors(['email' => 'Email tidak ditemukan.']);
            }

            $response = Password::broker($broker)->reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user, $password) {
                    $user->password = Hash::make($password);
                    $user->setRememberToken(Str::random(60));
                    $user->save();
                    event(new PasswordReset($user));
                }
            );

            Log::info('Reset password status untuk email: ' . $request->email . ' - Status: ' . $response);
            return $response === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', trans($response))
                : back()->withErrors(['email' => trans($response)]);
        } catch (\Exception $e) {
            Log::error('Reset password error: ' . $e->getMessage());
            return back()->withErrors(['email' => 'Terjadi kesalahan, coba lagi nanti.']);
        }
    }
}