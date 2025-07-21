<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke tabel employees
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->timestamp('scan_time'); // Waktu scan yang akurat
            $table->enum('status', ['Masuk', 'Pulang']); // Status saat scan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
