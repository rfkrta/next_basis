<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Check if the 'users' table already exists
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('nip')->unique()->nullable();
                $table->string('kota')->nullable();
                $table->string('alamat')->nullable();
                $table->string('agama')->nullable();    
                $table->date('tanggal_lahir')->nullable();
                $table->string('no_hp')->unique()->nullable();
                $table->string('email')->unique()->nullable();
                $table->timestamp('email_verified_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
                $table->string('password')->nullable();
                $table->string('jenis_kelamin')->nullable();
                $table->string('foto_profil')->nullable();
                // $table->string('fotoKTP')->nullable();
                // $table->string('nomorRekening')->nullable();
                $table->string('status')->nullable();
                $table->text('blacklistReason')->nullable();
                $table->date('blockDate')->nullable();
                $table->rememberToken();
                $table->timestamp('created_at')->nullable();
                // $table->timestamp('deleted_at')->nullable();
                $table->timestamp('updated_at')->nullable();
            });
        }
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
}
