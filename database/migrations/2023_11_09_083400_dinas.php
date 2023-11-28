<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('dinas', function (Blueprint $table) {
            $table->id();
            $table->string('id_mitras');
            $table->string('kota');
            $table->string('komisi');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('id_anggota1');
            $table->string('id_anggota2');
            $table->string('pic_perusahaan')->nullable();
            $table->string('jabatan_pic')->nullable();
            $table->string('kota_keberangkatan')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamp('updated_at')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('dinas');

    }
};
