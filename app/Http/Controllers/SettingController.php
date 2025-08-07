<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Menampilkan halaman pengaturan (settings).
     */
    public function index()
    {
        // Anda bisa mengambil data pengaturan dari database di sini jika ada.
        
        return view('setting.index');
    }
}