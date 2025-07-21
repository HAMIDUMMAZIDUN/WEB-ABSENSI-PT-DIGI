<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip',
        'name',
        'position',
        'department',
        'rfid_uid',
        'photo_path',
    ];

    // Relasi: Satu karyawan punya banyak catatan absensi
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
