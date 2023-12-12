<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventarisTable extends Migration
{
    public function up()
    {
        Schema::create('inventaris', function (Blueprint $table) {
            $table->id(); // Kolom ID otomatis
            $table->string('Kode');
            $table->string('Nama_Barang');
            $table->integer('Jumlah');
            $table->string('Kategori');
            $table->date('Tanggal_Diperoleh');
            // Tambahkan kolom-kolom lain sesuai kebutuhan aplikasi Anda
            $table->timestamps(); // Kolom otomatis untuk created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventaris');
    }
}
