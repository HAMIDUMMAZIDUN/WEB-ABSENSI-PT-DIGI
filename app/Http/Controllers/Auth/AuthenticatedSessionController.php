<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
// use App\Providers\RouteServiceProvider; // <-- BARIS INI DIHAPUS
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Menampilkan halaman view untuk login.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Menangani permintaan otentikasi yang masuk.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // PERUBAHAN DI SINI:
        // Mengarahkan ke rute bernama 'dashboard' bukan konstanta.
        // Method intended() akan mencoba mengarahkan ke halaman yang sebelumnya ingin diakses pengguna,
        // jika tidak ada, maka akan diarahkan ke 'dashboard'.
        return redirect()->intended(route('dashboard'));
    }

    /**
     * Menghancurkan sesi (logout) pengguna.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
