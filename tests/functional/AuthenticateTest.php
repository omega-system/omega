<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Omega\User;

class AuthenticateTest extends TestCase
{
    use DatabaseMigrations;

    public function testLogin()
    {
        // generate a random password
        $password = str_random();

        // given a nonexistent user
        $user = factory(User::class)->make([
            'password' => bcrypt($password)
        ]);

        // attempt to log in an nonexistent user
        $this->visit('/login')
            ->type($user->number, 'number')
            ->type($password, 'password')
            ->press('登录');

        // it fails
        $this->assertFalse(Auth::check());

        // persist that user
        $user->save();

        // attempt to log in that user with incorrect password
        $this->visit('/login')
            ->type($user->number, 'number')
            ->type('wrong_' . $password, 'password')
            ->press('登录');

        // it fails
        $this->assertFalse(Auth::check());

        // attempt to log in with that number and correct password
        // it redirects to dashboard
        $this->visit('/login')
            ->type($user->number, 'number')
            ->type($password, 'password')
            ->press('登录')
            ->seePageIs(route('dashboard.index'));

        // and logs in
        $this->assertEquals($user->number, Auth::user()->number);
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

        // and logs out
        $this->assertFalse(Auth::check());
    }
}
