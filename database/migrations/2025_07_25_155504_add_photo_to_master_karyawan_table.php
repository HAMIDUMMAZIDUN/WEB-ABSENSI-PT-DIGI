<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */public function up()
{
    Schema::table('master_karyawan', function (Blueprint $table) {
        // Menambahkan kolom untuk menyimpan path foto, bisa null
        $table->string('photo')->nullable()->after('email');
    });
}

public function down()
{
    Schema::table('master_karyawan', function (Blueprint $table) {
        $table->dropColumn('photo');
    });
}
};
