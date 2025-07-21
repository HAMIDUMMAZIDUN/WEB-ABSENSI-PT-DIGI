<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'scan_time',
        'status',
    ];

    // Relasi: Satu catatan absensi dimiliki oleh satu karyawan
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
