<?php

namespace Omega\Http\Controllers;

use Illuminate\Http\Request;
use Omega\Http\Requests;
use Omega\Repositories\PermissionRepositoryInterface;
use Omega\Repositories\RoleRepositoryInterface;
use Omega\Repositories\UserRepositoryInterface;

class UserController extends Controller
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;
    /**
     * @var RoleRepositoryInterface
     */
    private $roleRepository;
    /**
     * @var PermissionRepositoryInterface
     */
    private $permissionRepository;

    /**
     * UserController constructor.
     * @param UserRepositoryInterface $userRepository
     * @param RoleRepositoryInterface $roleRepository
     * @param PermissionRepositoryInterface $permissionRepository
     */
    public function __construct(UserRepositoryInterface $userRepository,
                                RoleRepositoryInterface $roleRepository,
                                PermissionRepositoryInterface $permissionRepository)
    {
        $this->middleware('permission:create.users|delete.users', ['only' => ['index', 'show']]);
        $this->middleware('permission:create.users', ['only' => ['create', 'store', 'edit', 'update']]);
        $this->middleware('permission:delete.users', ['only' => 'destroy']);

        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    public function index()
    {
        $users = $this->userRepository->getPaginated();
        $presenter = app('PaginationPresenter', [$users]);
        return view('dashboard.user.index', compact('users', 'presenter'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = $this->userRepository->getById($id);
        $roles = $this->roleRepository->getAll();
        $permissions = $this->permissionRepository->getAll();
        return view('dashboard.user.edit', compact('user', 'roles', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, $this->rules($id));
        $user = $this->userRepository->getById($id);
        $user->update($request->input());
        $user->roles()->sync($request->input('roles', []));
        $user->userPermissions()->sync($request->input('user_permissions', []));
        return redirect()->back();
    }

    /**
     * @param string $number
     * @return array
     */
    protected function rules($number = '')
    {
        return [
            'number' => 'required|digits:8|unique:users,number,' . $number,
            'name' => 'required|string|max:10',
        ];
    }

    public function destroy($id)
    {
        $user = $this->userRepository->getById($id);
        if ($user->deletable) {
            $user->delete();
        }
        return redirect()->back();
    }
}
