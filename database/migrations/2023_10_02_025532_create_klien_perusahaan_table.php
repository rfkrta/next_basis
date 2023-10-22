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
        Schema::create('klien_perusahaan', function (Blueprint $table) {
            $table->bigIncrements('id_klien_perusahaan');
            $table->unsignedBigInteger('nama_klien_perusahaan');
            $table->string('kota', 30);
            $table->string('alamat_perusahaan', 50);
            $table->string('nama_PIC_perusahaan', 50);
            $table->string('jabatan_PIC', 50);
            $table->string('nomer_telepon_PIC', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('klien_perusahaan');
    }
};
