<?php

namespace Omega\Http\Controllers;

use Illuminate\Http\Request;
use Omega\Http\Requests;
use Omega\Repositories\TrimesterRepositoryInterface;

class TrimesterController extends Controller
{
    /**
     * @var TrimesterRepositoryInterface
     */
    private $trimesterRepository;

    /**
     * UserController constructor.
     * @param TrimesterRepositoryInterface $trimesterRepository
     */
    public function __construct(TrimesterRepositoryInterface $trimesterRepository)
    {
        $this->middleware('permission:create.trimesters|delete.trimesters', ['only' => ['index', 'show']]);
        $this->middleware('permission:create.trimesters', ['only' => ['create', 'store', 'edit', 'update']]);
        $this->middleware('permission:delete.trimesters', ['only' => 'destroy']);

        $this->trimesterRepository = $trimesterRepository;
    }

    public function index()
    {
        $trimesters = $this->trimesterRepository->paginate();
        $presenter = app('PaginationPresenter', [$trimesters]);
        return view('dashboard.trimester.index', compact('trimesters', 'presenter'));
    }

    public function create()
    {
        $trimester = $this->trimesterRepository->new();
        return view('dashboard.trimester.create', compact('trimester'));
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rules());
        $this->trimesterRepository->create($request->input());
        return redirect()->route('dashboard.trimester.index');
    }

    /**
     * @return array
     */
    protected function rules()
    {
        return [
            '',
        ];
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $trimester = $this->trimesterRepository->getById($id);
        return view('dashboard.trimester.edit', compact('trimester'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, $this->rules());
        $trimester = $this->trimesterRepository->getById($id);
        $trimester->update($request->input());
        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->trimesterRepository->getById($id)->delete();
        return redirect()->route('dashboard.trimester.index');
    }
}
