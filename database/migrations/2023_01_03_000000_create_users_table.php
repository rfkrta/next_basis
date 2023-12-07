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
                $table->unsignedBigInteger('role_id')->nullable(); // Kolom untuk menampung ID peran (role)
                $table->foreign('role_id')->references('id')->on('roles'); // Menambahkan foreign key constraint
                $table->string('id_positions')->nullable();
                $table->string('gaji_posisi')->nullable();
                $table->date('tanggal_mulai')->nullable();
                $table->date('tanggal_selesai')->nullable();
                // $table->string('fotoKTP')->nullable();
                // $table->string('nomorRekening')->nullable();
                $table->text('blacklistReason')->nullable();
                $table->date('blockDate')->nullable();
                $table->rememberToken();
                $table->timestamp('created_at')->nullable();
                // $table->timestamp('deleted_at')->nullable();
                $table->timestamp('updated_at')->nullable();
                $table->string('status')->default('Aktif');
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']); // Menghapus foreign key constraint
            $table->dropColumn('role_id'); // Menghapus kolom role_id
        });
    }
}
