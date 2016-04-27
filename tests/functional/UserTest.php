<?php

use Bican\Roles\Models\Permission;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Omega\User;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp()
    {
        parent::setUp();

        // create a user
        $user = factory(User::class)->create();

        // that have permission to manage users
        $user->attachPermission(Permission::whereSlug('create.users')->firstOrFail());
        $user->attachPermission(Permission::whereSlug('delete.users')->firstOrFail());

        // acting as that user (prevent permission cache)
        $this->actingAs(User::whereNumber($user->number)->firstOrFail());
    }

    /**
     * list users
     */
    public function testIndex()
    {
        // create 3 users
        $users = factory(User::class)->times(3)->create();

        // they appear in dashboard.users.index
        $this->visit(route('dashboard.users.index'));
        foreach ($users as $user) {
            $this->see($user->number);
        }

        // delete these users
        foreach ($users as $user) {
            $user->delete();
        }

        // and they do not appear in dashboard.users.index
        $this->visit(route('dashboard.users.index'));
        foreach ($users as $user) {
            $this->dontSee($user->number);
        }
    }

    /**
     * create a user
     */
    public function testCreate()
    {
        // generate a random password
        $password = str_random();

        // make a user
        $user = factory(User::class)->make(compact('password'));

        // create that user with wrong confirmed password
        $this->visit(route('dashboard.users.create'))
            ->type($user->number, 'number')
            ->type($user->name, 'name')
            ->type($password, 'password')
            ->type('wrong_' . $password, 'password_confirmation')
            ->press('保存');

        // it does not appear in database
        $this->dontSeeInDatabase('users', ['number' => $user->number]);

        // create that user with correct confirmed password
        // and assign student role and create.announcements permission
        $this->visit(route('dashboard.users.create'))
            ->submitForm('保存', [
                'number' => $user->number,
                'name' => $user->name,
                'password' => $password,
                'password_confirmation' => $password,
                'roles' => [3 => 4],
                'user_permissions' => [0 => 1],
            ]);

        // it appears in database
        $this->seeInDatabase('users', ['number' => $user->number]);

        // fetch it from database
        $user = User::whereNumber($user->number)->firstOrFail();

        // it has student role
        $this->assertTrue($user->isStudent());

        // it has create.announcements permission
        $this->assertTrue($user->canCreateAnnouncements());
    }

    /**
     * edit a user
     */
    public function testEdit()
    {
        // given a user
        $user = factory(User::class)->create();

        // and make a new one
        $anotherUser = factory(User::class)->make();

        // edit that user without changing password
        $this->visit(route('dashboard.users.edit', [$user->id]))
            ->submitForm('保存', [
                'number' => $anotherUser->number,
                'name' => $anotherUser->name,
                'password' => '',
                'password_confirmation' => '',
                'roles' => [3 => 4],
                'user_permissions' => [0 => 1],
            ]);

        // new user information appears in database
        $this->seeInDatabase('users', [
            'number' => $anotherUser->number,
            'name' => $anotherUser->name,
            'password' => $user->password,
        ]);

        // fetch it from database (flush the cache)
        $user = User::findOrFail($user->id);

        // and it has proper roles and permissions
        $this->assertTrue($user->isStudent());
        $this->assertTrue($user->canCreateAnnouncements());
    }

    /**
     * delete a user
     */
}
