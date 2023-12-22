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
        Schema::create('komisi_dinas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->constrained();
            $table->integer('id_mitras');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->integer('komisi_dinas');
<<<<<<< Updated upstream
<<<<<<< Updated upstream
<<<<<<< Updated upstream
<<<<<<< Updated upstream
=======
            $table->integer('dinas_id');
>>>>>>> Stashed changes
=======
            $table->integer('dinas_id');
>>>>>>> Stashed changes
=======
            $table->integer('dinas_id');
>>>>>>> Stashed changes
=======
            $table->integer('dinas_id');
>>>>>>> Stashed changes
            $table->SoftDeletes();
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
        Schema::dropIfExists('komisi_dinas');
    }
};
