<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Method ini akan menampilkan view dashboard
    public function index()
    {
        // Nantinya, Anda bisa menambahkan data ke sini.
        // Contoh: $jumlahKaryawan = Employee::count();
        return view('dashboard');
    }
}