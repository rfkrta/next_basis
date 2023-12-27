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
        Schema::create('biaya_perbandingans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('perjalanan_dinas_id');
            $table->integer('biaya_perbandingan_hotel')->nullable();
            $table->string('keterangan_perbandingan_hotel');
            $table->integer('biaya_perbandingan_transportasi')->nullable();
            $table->string('keterangan_perbandingan_transportasi');
            $table->integer('biaya_perbandingan_konsumsi')->nullable();
            $table->string('keterangan_perbandingan_konsumsi');
            $table->integer('biaya_perbandingan_lain')->nullable();
            $table->string('keterangan_perbandingan_lain');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('biaya_perbandingans');
    }
};
