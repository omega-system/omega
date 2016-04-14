<?php

use Illuminate\Database\Schema\Blueprint;
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
                   ->firstOrFail()
                   ->update(['name' => '']);
    }
}
