<?php

namespace Omega\Http\Controllers;

use Illuminate\Contracts\Pagination\Presenter;
use Illuminate\Http\Request;
use Omega\Http\Requests;
use Omega\Repositories\UserRepositoryInterface;

class UserController extends Controller
{
    /**
     * @var UserRepositoryInterface
     */
    private $repo;

    public function __construct(UserRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $users = $this->repo->getPaginated();
        return view('dashboard.user.index')
            ->withUsers($users)
            ->withPresenter(app('PaginationPresenter', [$users]));
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
        $user = $this->repo->getById($id);
        return view('dashboard.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $this->repo->getById($id)->update($request->input());
        return redirect()->back();
    }

    public function destroy($id)
    {
        //
    }
}
