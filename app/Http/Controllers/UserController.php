<?php

namespace Omega\Http\Controllers;

use Bican\Roles\Models\Permission;
use Bican\Roles\Models\Role;
use Illuminate\Http\Request;
use Omega\Http\Requests;
use Omega\User;

class UserController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:create.users|delete.users', ['only' => ['index', 'show']]);
        $this->middleware('permission:create.users', ['only' => ['create', 'store', 'edit', 'update']]);
        $this->middleware('permission:delete.users', ['only' => 'destroy']);
    }

    public function index()
    {
        $users = User::with('roles')->paginate();
        $presenter = app('PaginationPresenter', [$users]);
        return view('dashboard.users.index', compact('users', 'presenter'));
    }

    public function create(User $user)
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('dashboard.users.create', compact('user', 'roles', 'permissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rules());
        $user = User::create($request->input());
        $user->roles()->sync($request->input('roles', []));
        $user->userPermissions()->sync($request->input('user_permissions', []));
        return redirect()->route('dashboard.users.index');
    }

    /**
     * @param string $id
     * @return array
     */
    protected function rules($id = '')
    {
        return [
            'number' => 'required|digits:8|unique:users,number,' . $id,
            'name' => 'required|string|max:10',
        ];
    }

    public function show($id)
    {
        //
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('dashboard.users.edit', compact('user', 'roles', 'permissions'));
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, $this->rules($user->id));
        $user->update($request->input());
        $user->roles()->sync($request->input('roles', []));
        $user->userPermissions()->sync($request->input('user_permissions', []));
        return redirect()->back();
    }

    public function destroy(User $user)
    {
        if ($user->deletable) {
            $user->delete();
        }
        return redirect()->route('dashboard.users.index');
    }
}
