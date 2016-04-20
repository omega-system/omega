<?php

use Bican\Roles\Models\Permission;
use Bican\Roles\Models\Role;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrimestersPermissionsAndAttachToAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $adminRole = Role::whereSlug('admin')->firstOrFail();

        $createTrimestersPermission = Permission::create([
            'name' => '创建和修改学期',
            'slug' => 'create.trimesters'
        ]);

        $deleteTrimestersPermission = Permission::create([
            'name' => '删除学期',
            'slug' => 'delete.trimesters'
        ]);

        $adminRole->attachPermission($createTrimestersPermission);
        $adminRole->attachPermission($deleteTrimestersPermission);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Permission::whereSlug('create.trimesters')->delete();
        Permission::whereSlug('delete.trimesters')->delete();
    }
}
