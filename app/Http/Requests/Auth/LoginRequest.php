<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Tentukan apakah pengguna berwenang untuk membuat permintaan ini.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Dapatkan aturan validasi yang berlaku untuk permintaan.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        // Menambahkan validasi untuk 'role'
        return [
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
            'role' => ['required', 'string', 'in:administrator,karyawan'], // Pastikan role yang dikirim valid
        ];
    }

    /**
     * Coba untuk mengotentikasi kredensial permintaan.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        // KITA MODIFIKASI BAGIAN INI
        // 1. Ambil kredensial 'username' dan 'password' dari form.
        $credentials = $this->only('username', 'password');
        
        // 2. Tambahkan 'role' ke dalam array kredensial.
        // Auth::attempt akan mencari user dengan username, password, DAN role yang cocok.
        $credentials['role'] = $this->input('role');

        if (! Auth::attempt($credentials, $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'username' => __('auth.failed'), // Pesan error umum untuk keamanan
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Pastikan permintaan login tidak dibatasi oleh rate limiter.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'username' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Dapatkan kunci throttle untuk permintaan tersebut.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('username')).'|'.$this->ip());
    }
}
