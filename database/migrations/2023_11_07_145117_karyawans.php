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
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->string('id_positions')->nullable();
            $table->string('nip')->nullable();
            $table->string('gaji_posisi')->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
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
        Schema::dropIfExists('karyawans');
    }
};
