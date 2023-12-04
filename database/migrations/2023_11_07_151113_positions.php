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
        Schema::create('positions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_posisi', 100);
            $table->decimal('gaji_posisi', 12, 2); // Store salary as decimal for precision
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });

        // Inserting data with salary values in IDR (assuming 1 IDR = 1000)
        DB::table('positions')->insert([
            ['nama_posisi' => 'Admin', 'gaji_posisi' => 1000000], // 1,000,000 IDR
            ['nama_posisi' => 'Super Admin', 'gaji_posisi' => 500000], // 500,000 IDR
            ['nama_posisi' => 'Normal User', 'gaji_posisi' => 250000], // 250,000 IDR
            ['nama_posisi' => 'Employee', 'gaji_posisi' => 200000], // 200,000 IDR
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
