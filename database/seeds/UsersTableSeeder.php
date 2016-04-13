<?php

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
        User::create([
            'number' => '10000000',
            'password' => bcrypt('123456')
        ]);
    }
}
