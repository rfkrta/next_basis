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
            $table->integer('gaji_posisi');
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
        DB::table('positions')->insert([
            ['nama_posisi' => '	Manager Information Technology', 'gaji_posisi' => 1000000],
            ['nama_posisi' => 'Manager Human Resource', 'gaji_posisi' => 500000],
            // ['nama_posisi' => 'Normal User', 'gaji_posisi' => 250000],
            ['nama_posisi' => 'Employee', 'gaji_posisi' => 5000000],
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
