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
        $roles = [
            ['name' => 'Admin'],
            ['name' => 'Supervisor'],
            ['name' => 'Pegawai'],
            ['name' => 'Inactive']
        ];

        DB::table('roles')->insert($roles);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        DB::table('roles')->whereIn('name', ['Admin', 'Supervisor', 'Pegawai', 'Inactive'])->delete();
    }
};
