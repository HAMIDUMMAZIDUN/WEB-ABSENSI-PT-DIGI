<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest; // Kita akan gunakan ini
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * ✅ Menampilkan halaman view untuk login.
     * Method ini yang hilang dari kode Anda.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * 🛡️ Menangani permintaan otentikasi yang masuk.
     * Diperbaiki untuk menggunakan LoginRequest yang lebih aman.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Validasi dan percobaan login sudah ditangani oleh authenticate()
        $request->authenticate();

        // Regenerasi session untuk keamanan
        $request->session()->regenerate();

        // Redirect ke halaman yang dituju atau ke HOME
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * 🔄 Menghancurkan sesi (logout) pengguna.
     * Method ini penting untuk fungsionalitas logout.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}