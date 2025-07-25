<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterKaryawan extends Model
{
    use HasFactory;

    /**
     * Menentukan nama tabel yang terhubung dengan model ini.
     * Diperlukan karena nama tabel 'master_karyawan' tidak mengikuti
     * konvensi standar Laravel (yang seharusnya 'master_karyawans').
     */
    protected $table = 'master_karyawan';

    /**
     * Kolom-kolom yang diizinkan untuk diisi secara massal (mass assignable).
     * Ini penting untuk keamanan dan akan digunakan nanti saat
     * membuat fungsi tambah/edit data.
     */
    protected $fillable = [
    'nik',
    'nama',
    'email',
    'photo', 
    'phone',
    'alamat',
    'dept',
    'dept_colour',
    'role',
    'join_date',
    'status',
    'status_colour'
];
}
