<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index()
    {
        // Data karyawan bisa diambil dari database di sini.
        // Untuk contoh ini, kita buat data statis.
        $employees = [
            ['name' => 'Hamid Abdul', 'email' => 'hamidabdul@gmail.com', 'nik' => '3215281805040020', 'phone' => '0812-1481-9847', 'dept' => 'Engineer', 'dept_color' => 'bg-red-500', 'role' => 'Lead. Front End Dev', 'join_date' => '20/01/2025', 'status' => 'Aktif', 'status_color' => 'green'],
            ['name' => 'Mustara Fatimah', 'email' => 'mustara.fatimah@gmail.com', 'nik' => '3215281002040124', 'phone' => '0819-9396-5692', 'dept' => 'Finance', 'dept_color' => 'bg-purple-500', 'role' => 'Lead. Accountant', 'join_date' => '08/03/2025', 'status' => 'Aktif', 'status_color' => 'green'],
            ['name' => 'Zaky Afriansyah', 'email' => 'zakyafr@gmail.com', 'nik' => '3215282804040008', 'phone' => '0812-1556-9969', 'dept' => 'Product', 'dept_color' => 'bg-indigo-500', 'role' => 'Lead. Product Manager', 'join_date' => '13/04/2025', 'status' => 'Aktif', 'status_color' => 'green'],
            ['name' => 'Dira Nufin', 'email' => 'diranufin@gmail.com', 'nik' => '3215271108002503', 'phone' => '0821-1118-7005', 'dept' => 'Marketing', 'dept_color' => 'bg-green-500', 'role' => 'Jr. Digital Marketing', 'join_date' => '18/04/2025', 'status' => 'Tidak Aktif', 'status_color' => 'red'],
            ['name' => 'Saha Syifa', 'email' => 'sahasyifa@gmail.com', 'nik' => '3215320805410110', 'phone' => '0858-8296-1792', 'dept' => 'Marketing', 'dept_color' => 'bg-green-500', 'role' => 'Sr. Content Writer', 'join_date' => '08/06/2025', 'status' => 'Cuti', 'status_color' => 'yellow'],
            ['name' => 'Zazifi Fadilah', 'email' => 'zazififad@gmail.com', 'nik' => '3215341401011110', 'phone' => '0895-3430-91637', 'dept' => 'Engineer', 'dept_color' => 'bg-red-500', 'role' => 'Sr. DevOps', 'join_date' => '10/06/2025', 'status' => 'Aktif', 'status_color' => 'green'],
            ['name' => 'Audrey', 'email' => 'audrey@gmail.com', 'nik' => '3215340506042008', 'phone' => '0895-7028-29096', 'dept' => 'Product', 'dept_color' => 'bg-indigo-500', 'role' => 'Sr. UI/UX Designer', 'join_date' => '07/08/2025', 'status' => 'Cuti', 'status_color' => 'yellow'],
            ['name' => 'Zakiyah Risyad', 'email' => 'zakiyahris@gmail.com', 'nik' => '3275322207990135', 'phone' => '0852-1070-4130', 'dept' => 'Finance', 'dept_color' => 'bg-purple-500', 'role' => 'Sr. Accountant', 'join_date' => '30/08/2025', 'status' => 'Tidak Aktif', 'status_color' => 'red'],
        ];

        // Mengirim data ke view
        return view('karyawan.index', ['employees' => $employees]);
    }
}