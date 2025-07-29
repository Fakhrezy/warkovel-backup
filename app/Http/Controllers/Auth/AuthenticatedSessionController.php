<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        Session::regenerate();

        // Redirect berdasarkan role user setelah login
        $user = Auth::user();

        // Set session flash message untuk login berhasil
        Session::flash('login_success', 'Login berhasil! Selamat datang, ' . $user->name . '.');        // Admin redirect (tetap menggunakan role)
        if ($user->hasRole('admin')) {
            return redirect()->intended(route('admin.dashboard'));
        }

        // Kasir redirect ke halaman kasir
        if ($user->hasRole('kasir')) {
            return redirect()->intended(route('kasir.dashboard'));
        }

        // Barista redirect ke halaman barista
        if ($user->hasRole('barista')) {
            return redirect()->intended(route('barista.dashboard'));
        }

        // Semua staff (semua posisi) ke halaman absensi
        if ($user->hasRole('staff')) {
            return redirect()->intended(route('karyawan.dashboard'));
        }

        // Legacy: Karyawan role (jika masih ada)
        if ($user->hasRole('karyawan')) {
            return redirect()->intended(route('karyawan.dashboard'));
        }

        // Default fallback ke dashboard umum
        return redirect()->intended(route('dashboard'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
