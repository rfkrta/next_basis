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
        Schema::create('status_karyawans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_status')->nullable();
            $table->timestamps();
        });

        DB::table('status_karyawans')->insert([
            ['nama_status' => 'Active'],
            ['nama_status' => 'Inactive'],
            ['nama_status' => 'Disable']
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
        Schema::dropIfExists('dinas');
    }
};
