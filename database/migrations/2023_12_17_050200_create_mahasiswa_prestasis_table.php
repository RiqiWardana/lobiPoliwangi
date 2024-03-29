<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mahasiswa_prestasi', function (Blueprint $table) {
            $table->id();
            $table->String('nim');
            $table->String('nama_mahasiswa');
            $table->foreignId('prestasi_id');
            $table->foreignId('jurusan_id');
            $table->foreignId('account_admin_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa_prestasi');
    }
};
