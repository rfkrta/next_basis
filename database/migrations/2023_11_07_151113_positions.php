<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('positions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_posisi', 100);
            $table->integer('gaji_posisi');
            $table->timestamp('deleted_at')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
        DB::table('positions')->insert([
            ['nama_posisi' => 'Admin', 'gaji_posisi' => 1],
            ['nama_posisi' => 'Super Admin', 'gaji_posisi' => 1],
            ['nama_posisi' => 'Normal User', 'gaji_posisi' => 1],
            ['nama_posisi' => 'Employee', 'gaji_posisi' => 1],
        ]);        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('positions');
    }
};
