<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Omega\User;

class AccountTest extends TestCase
{
    use DatabaseMigrations;

    public function testLogin()
    {
        // attempt to log in an nonexistent user
        // it fails
        $this->visit('/login')
            ->type('99999999', 'number')
            ->type('123456', 'password')
            ->press('登录')
            ->seePageIs('/login');

        // given a user
        $user = factory(User::class)->create([
            'password' => bcrypt('secret')
        ]);

        // attempt to log in with that number and incorrect password
        // it fails
        $this->visit('/login')
            ->type($user->number, 'number')
            ->type('incorrect_secret', 'password')
            ->press('登录')
            ->seePageIs('/login');

        // attempt to log in with that number and correct password
        // it redirects to dashboard
        $this->visit('/login')
            ->type($user->number, 'number')
            ->type('secret', 'password')
            ->press('登录')
            ->seePageIs(route('dashboard.index'));
    }

    public function testLogout()
    {
        // given a user
        $user = factory(User::class)->create();

        // act as that user
        // visit logout
        // it redirects to /
        $this->actingAs($user)
            ->get('/logout')
            ->assertRedirectedTo('/');
    }
}
