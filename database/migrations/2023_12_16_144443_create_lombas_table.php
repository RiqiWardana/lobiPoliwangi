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
        Schema::create('lomba', function (Blueprint $table) {
            $table->id();
            $table->String('nama_lomba');
            $table->foreignId('instansi_lomba_id');
            $table->String('link_pendaftaran');
            $table->text('persyaratan');
            $table->date('tanggal_penutupan');
            $table->String('data_foto');
            $table->foreignId('tingkatan_id');
            $table->foreignId('status_id');
            $table->foreignId('account_admin_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lomba');
    }
};
