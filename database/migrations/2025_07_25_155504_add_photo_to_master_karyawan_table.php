<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * This method creates the 'master_karyawan' table with all the required columns.
     */
    public function up(): void
    {
        Schema::create('master_karyawan', function (Blueprint $table) {
            // Basic identifier for the record
            $table->id();

            // Corresponds to 'FOTO' in the image. Stores the path to the user's photo.
            // Nullable because a user might not have a photo initially.
            $table->string('foto')->nullable();

            // Corresponds to 'NIK'. Must be unique for each employee.
            $table->string('nik')->unique();

            // Corresponds to 'NAMA KARYAWAN'.
            $table->string('nama_karyawan');

            // Corresponds to 'EMAIL'. Must be unique.
            $table->string('email')->unique();

            // Corresponds to 'BAGIAN' (Department/Division).
            $table->string('bagian');

            // Corresponds to 'ROLE'. We use an ENUM for predefined roles.
            $table->enum('role', ['admin', 'karyawan', 'manager', 'hrd']);

            // Corresponds to 'STATUS'. ENUM for employment status.
            $table->enum('status', ['aktif', 'tidak_aktif', 'cuti', 'resign']);

            // Corresponds to 'TANGGAL BERGABUNG'. Stores the joining date.
            $table->date('tanggal_bergabung');

            // Corresponds to 'ALAMAT'. Using TEXT for longer addresses. Nullable.
            $table->text('alamat')->nullable();

            // Corresponds to 'KONTAK (PHONE)'.
            $table->string('kontak');

            // Default Laravel timestamp columns (created_at, updated_at).
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * This method will drop the entire 'master_karyawan' table if the migration is rolled back.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_karyawan');
    }
};
