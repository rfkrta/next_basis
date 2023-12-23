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
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kategoriabsen_id')->nullable(); // Kolom untuk menampung ID peran (role)
            $table->foreign('kategoriabsen_id')->references('id')->on('kategori_absensis'); // Menambahkan foreign key constraint
            $table->unsignedBigInteger('user_id'); // Kolom untuk menampung ID user
            $table->foreign('user_id')->references('id')->on('users'); // Menambahkan foreign key constraint ke tabel 'users'
            $table->date('tanggal');
            $table->time('waktu_selesai')->nullable();
            $table->time('waktu_mulai')->nullable();
            $table->string('file_img')->nullable();
            $table->point('lokasi')->nullable();
<<<<<<< Updated upstream
<<<<<<< Updated upstream
=======
            $table->string('status')->nullable();
            $table->SoftDeletes();
>>>>>>> Stashed changes
=======
            $table->string('status')->nullable();
            $table->SoftDeletes();
>>>>>>> Stashed changes
            // Tambahkan kolom lain jika diperlukan
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
        Schema::dropIfExists('absensis');
    }
};
