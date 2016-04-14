<?php

<<<<<<< HEAD
=======
use Illuminate\Database\Schema\Blueprint;
>>>>>>> bd32a9a79386abc05c5611aec8a281a8ecfebd3e
use Illuminate\Database\Migrations\Migration;
use Omega\User;

class UpdateSuperAdminName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        User::where(['number' => '00000000'])
            ->firstOrFail()
            ->update(['name' => '超级管理员']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        User::where(['number' => '00000000'])
<<<<<<< HEAD
            ->firstOrFail()
            ->update(['name' => '']);
=======
                   ->firstOrFail()
                   ->update(['name' => '']);
>>>>>>> bd32a9a79386abc05c5611aec8a281a8ecfebd3e
    }
}
