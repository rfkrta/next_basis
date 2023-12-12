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
        Schema::create('perjalanan_dinas', function (Blueprint $table) {
            $table->id('id_perjalan_dinas');
            $table->unsignedBigInteger('id_status_perjalanan_dinas');
            $table->unsignedBigInteger('id_klien_perusahaan');
            $table->unsignedBigInteger('id_user');
            $table->string('kota_keberangkatan', 30);
            $table->date('tanggal_mulai');
            $table->date('tanggal_berakhir');
            $table->timestamps();
            $table->index('id_user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perjalanan_dinas');
    }
};
