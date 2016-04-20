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
     * UserController constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->middleware('permission:create.users|delete.users', ['only' => ['index', 'show']]);
        $this->middleware('permission:create.users', ['only' => ['create', 'store', 'edit', 'update']]);
        $this->middleware('permission:delete.users', ['only' => 'destroy']);

        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->paginate($this->userRepository->getAllWithRoles());
        $presenter = app('PaginationPresenter', [$users]);
        return view('dashboard.user.index', compact('users', 'presenter'));
    }

    public function create(RoleRepositoryInterface $roleRepository,
                           PermissionRepositoryInterface $permissionRepository)
    {
        $user = $this->userRepository->new();
        $roles = $roleRepository->getAll();
        $permissions = $permissionRepository->getAll();
        return view('dashboard.user.create', compact('user', 'roles', 'permissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rules());
        $user = $this->userRepository->create($request->input());
        $user->roles()->sync($request->input('roles', []));
        $user->userPermissions()->sync($request->input('user_permissions', []));
        return redirect()->route('dashboard.user.index');
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

    public function edit(RoleRepositoryInterface $roleRepository,
                         PermissionRepositoryInterface $permissionRepository,
                         $id)
    {
        $user = $this->userRepository->getById($id);
        $roles = $roleRepository->getAll();
        $permissions = $permissionRepository->getAll();
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

    public function destroy($id)
    {
        $user = $this->userRepository->getById($id);
        if ($user->deletable) {
            $user->delete();
        }
        return redirect()->route('dashboard.user.index');
    }
}
