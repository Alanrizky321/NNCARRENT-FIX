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
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        try {
            // Cek apakah email ada di tabel admin
            if (Admin::where('email', $request->email)->exists()) {
                if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
                    return redirect()->route('dashboardadmin')->with('success', 'Login Admin berhasil!');
                }
            }
            // Cek apakah email ada di tabel pelanggan
            elseif (Pelanggan::where('email', $request->email)->exists()) {
                if (Auth::guard('pelanggan')->attempt(['email' => $request->email, 'password' => $request->password])) {
                    return redirect()->route('dashboard')->with('success', 'Login Pelanggan berhasil!');
                }
            }

            return back()->withErrors([
                'email' => 'Email atau password salah.',
            ])->withInput();
        } catch (\Exception $e) {
            // Catat error untuk debugging
            Log::error('Login error: ' . $e->getMessage());
            return back()->withErrors([
                'email' => 'Email atau password salah.',
            ])->withInput();
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
        // Validasi input
        $request->validate([
            'email' => 'required|email|unique:pelanggan,email',
            'no_hp' => 'required|string|max:13',
            'password' => 'required|min:6|confirmed',
        ]);

        try {
            // Simpan data pelanggan ke database
            $pelanggan = Pelanggan::create([
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'password' => Hash::make($request->password),
            ]);

            // Redirect ke halaman login dengan pesan sukses
            return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
        } catch (\Exception $e) {
            // Catat error untuk debugging
            Log::error('Registrasi error: ' . $e->getMessage());
            return back()->withErrors(['email' => 'Terjadi kesalahan saat registrasi. Coba lagi nanti.'])->withInput();
        }
    }

    // Logout pengguna (admin atau pelanggan)
    public function logout(Request $request)
    {
        Log::info('Logout dipanggil.');

        if (Auth::guard('admin')->check()) {
            Log::info('Logout admin');
            Auth::guard('admin')->logout();
        } elseif (Auth::guard('pelanggan')->check()) {
            Log::info('Logout pelanggan');
            Auth::guard('pelanggan')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda telah logout.');
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
            // Cek apakah email ada di tabel admin atau pelanggan
            $broker = Admin::where('email', $request->email)->exists() ? 'admins' : 'pelanggan';

            // Jika email tidak ada di kedua tabel
            if (!Admin::where('email', $request->email)->exists() && !Pelanggan::where('email', $request->email)->exists()) {
                return back()->withErrors(['email' => 'Email tidak ditemukan.']);
            }

            // Kirim link reset password
            $response = Password::broker($broker)->sendResetLink(['email' => $request->email]);

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
            // Tentukan broker berdasarkan tabel tempat email ditemukan
            $broker = Admin::where('email', $request->email)->exists() ? 'admins' : 'pelanggan';

            // Cek apakah email ada di tabel yang sesuai
            if (!Admin::where('email', $request->email)->exists() && !Pelanggan::where('email', $request->email)->exists()) {
                return back()->withErrors(['email' => 'Email tidak ditemukan.']);
            }

            // Proses reset password
            $response = Password::broker($broker)->reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user, $password) {
                    $user->password = Hash::make($password);
                    $user->setRememberToken(Str::random(60));
                    $user->save();
                    event(new PasswordReset($user));
                }
            );

            return $response === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', trans($response))
                : back()->withErrors(['email' => trans($response)]);
        } catch (\Exception $e) {
            Log::error('Reset password error: ' . $e->getMessage());
            return back()->withErrors(['email' => 'Terjadi kesalahan, coba lagi nanti.']);
        }
    }
}
