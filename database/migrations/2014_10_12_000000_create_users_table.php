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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('nik')->unique();
            $table->string('nip')->unique();
            $table->string('kota');
            $table->string('alamat');
            $table->enum('agama', ['Islam', 'Kristen Protestan', 'Kristen Katholik', 'Buddha', 'Hindu', 'Kong Hu Cu']);
            $table->date('tanggal_lahir');
            $table->string('no_hp')->unique()->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('jenis_kelamin', ['Pria', 'Wanita']);
            $table->string('foto_profil')->nullable();
            // $table->string('fotoKTP')->nullable();
            // $table->string('nomorRekening')->nullable();
            $table->enum('status', ['Active', 'Inactive', 'Blacklist']);
            $table->text('blacklistReason')->nullable();
            $table->date('blockDate')->nullable();
            $table->rememberToken();
            $table->timestamp('created_at')->default(now())->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
