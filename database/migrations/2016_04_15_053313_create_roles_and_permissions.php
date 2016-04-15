<?php

use Bican\Roles\Models\Permission;
use Bican\Roles\Models\Role;
use Illuminate\Database\Migrations\Migration;
use Omega\User;

class CreateRolesAndPermissions extends Migration
{
    private $roles = [
        [
            'name' => '超级管理员',
            'slug' => 'super.admin',
            'level' => 10
        ],
        [
            'name' => '管理员',
            'slug' => 'admin',
            'level' => 9
        ],
        [
            'name' => '教师',
            'slug' => 'teacher'
        ],
        [
            'name' => '学生',
            'slug' => 'student'
        ]
    ];

    private $permissions = [
        [
            'name' => '发布和修改公告',
            'slug' => 'create.announcements'
        ],
        [
            'name' => '删除公告',
            'slug' => 'delete.announcements'
        ],
        [
            'name' => '创建和修改用户',
            'slug' => 'create.users'
        ],
        [
            'name' => '删除用户',
            'slug' => 'delete.users'
        ],
        [
            'name' => '创建和修改课程',
            'slug' => 'create.courses'
        ],
        [
            'name' => '删除课程',
            'slug' => 'delete.courses'
        ],
        [
            'name' => '创建和修改班级',
            'slug' => 'create.classes'
        ],
        [
            'name' => '删除班级',
            'slug' => 'delete.classes'
        ]
    ];

    private $rolePermissions = [
        'admin' => [
            'create.announcements',
            'delete.announcements',
            'create.users',
            'delete.users',
            'create.courses',
            'delete.courses',
            'create.classes',
            'delete.classes'
        ]
    ];

    private $userRoles = [
        '00000000' => ['admin']
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
         * Create roles
         */

        foreach ($this->roles as $role) {
            Role::create($role);
        }

        /*
         * Create permissions
         */

        foreach ($this->permissions as $permission) {
            Permission::create($permission);
        }

        /*
         * Attach permissions to roles
         */

        foreach ($this->rolePermissions as $role => $permissions) {
            $role = Role::where('slug', $role)->firstOrFail();
            foreach ($permissions as $permission) {
                $permission = Permission::where('slug', $permission)->firstOrFail();
                $role->attachPermission($permission);
            }
        }

        /*
         * Attach roles to users
         */

        foreach ($this->userRoles as $user => $roles) {
            $user = User::where('number', $user)->firstOrFail();
            foreach ($roles as $role) {
                $role = Role::where('slug', $role)->firstOrFail();
                $user->attachRole($role);
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /*
         * Detach roles from users
         */

        foreach ($this->userRoles as $user => $roles) {
            $user = User::where('number', $user)->firstOrFail();
            foreach ($roles as $role) {
                $role = Role::where('slug', $role)->firstOrFail();
                $user->detachRole($role);
            }
        }

        /*
         * Detach permissions from roles
         */

        foreach ($this->rolePermissions as $role => $permissions) {
            $role = Role::where('slug', $role)->firstOrFail();
            foreach ($permissions as $permission) {
                $permission = Permission::where('slug', $permission)->firstOrFail();
                $role->detachPermission($permission);
            }
        }

        /*
         * Delete permissions
         */

        foreach ($this->permissions as $permission) {
            $permission = Permission::where('slug', $permission['slug'])->firstOrFail();
            $permission->delete();
        }

        /*
         * Delete roles
         */

        foreach ($this->roles as $role) {
            $role = Role::where('slug', $role['slug'])->firstOrFail();
            $role->delete();
        }
    }
}
