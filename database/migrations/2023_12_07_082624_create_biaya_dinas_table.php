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
        Schema::create('biaya_dinas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('perjalanan_dinas_id');
            $table->integer('biaya_hotel');
            $table->string('keterangan_hotel');
            $table->integer('biaya_transportasi');
            $table->string('keterangan_transportasi');
            $table->integer('biaya_konsumsi');
            $table->string('keterangan_konsumsi');
            $table->integer('biaya_lain');
            $table->string('keterangan_lain');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('biaya_dinas');
    }
};
