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
    Schema::create('master_karyawan', function (Blueprint $table) {
        $table->id();
        // ... (other existing columns in your create migration)
        $table->string('email')->nullable(); // Add this line
        $table->string('photo')->nullable(); // Add this line
        $table->timestamps();
    });
}

public function down()
{
    Schema::table('master_karyawan', function (Blueprint $table) {
        $table->dropColumn('photo');
    });
}
};
