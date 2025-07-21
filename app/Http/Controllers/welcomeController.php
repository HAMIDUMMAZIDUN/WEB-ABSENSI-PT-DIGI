<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class welcomeController extends Controller
{
    /**
     * Menampilkan halaman informasi kelompok.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        // Controller ini hanya mengembalikan view 'info-kelompok'
        return view('welcome');
    }
}