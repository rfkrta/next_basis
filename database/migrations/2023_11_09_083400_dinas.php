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
        Schema::create('dinas', function (Blueprint $table) {
            $table->id();
            $table->string('id_mitras');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('id_anggota1');
            $table->string('id_anggota2');
            $table->string('id_anggota3')->nullable();
            $table->string('id_anggota4')->nullable();
            $table->string('nama_PIC_perusahaan')->nullable();
            $table->string('jabatan_PIC')->nullable();
            $table->string('kota_keberangkatan')->nullable();
            $table->string('komisi_dinas')->nullable();
            $table->integer('jumlah_anggota')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            // Menambahkan kolom untuk upload berita acara
            $table->string('berita_acara')->nullable();
            // Menambahkan kolom untuk upload bukti surat
            $table->string('bukti_surat')->nullable();
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
        Schema::dropIfExists('dinas');
        Schema::table('dinas', function (Blueprint $table) {
            // Menghapus kolom berita acara dan bukti surat jika diperlukan
            $table->dropColumn(['berita_acara', 'bukti_surat']);
        });
    }
};
