<?php

use Bican\Roles\Models\Role;
use Illuminate\Database\Seeder;
use Omega\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teacherRole = Role::whereSlug('teacher')->firstOrFail();
        $studentRole = Role::whereSlug('student')->firstOrFail();
        $hashedPassword = bcrypt('123456');
        for ($i = 1; $i <= 100; $i++) {
            $teacher = User::create([
                'number' => sprintf('%08d', $i),
                'name' => str_random(),
                'password' => $hashedPassword
            ]);
            $student = User::create([
                'number' => sprintf('1%07d', $i),
                'name' => str_random(),
                'password' => $hashedPassword
            ]);
            $teacher->attachRole($teacherRole);
            $student->attachRole($studentRole);
        }
    }
}
