<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('nip')->unique(); // Nomor Induk Pegawai
            $table->string('name');
            $table->string('position'); // Jabatan
            $table->string('department'); // Departemen
            $table->string('rfid_uid')->unique(); // ID unik dari kartu RFID
            $table->string('photo_path')->nullable(); // Path ke foto karyawan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
