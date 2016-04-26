<?php

namespace Omega\Http\Controllers;

use Illuminate\Http\Request;
use Omega\Http\Requests;
use Omega\Trimester;

class TrimesterController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:create.trimesters|delete.trimesters', ['only' => ['index', 'show']]);
        $this->middleware('permission:create.trimesters', ['only' => ['create', 'store', 'edit', 'update']]);
        $this->middleware('permission:delete.trimesters', ['only' => 'destroy']);
    }

    public function index()
    {
        $trimesters = Trimester::paginate();
        $presenter = app('PaginationPresenter', [$trimesters]);
        return view('dashboard.trimesters.index', compact('trimesters', 'presenter'));
    }

    public function create(Trimester $trimester)
    {
        return view('dashboard.trimesters.create', compact('trimester'));
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rules());
        Trimester::create($request->input());
        return redirect()->route('dashboard.trimesters.index');
    }

    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'year' => 'required|digits:4',
            'sequence' => 'required|numeric',
            'trimester_name' => 'required|max:20',
        ];
    }

    public function show($id)
    {
        //
    }

    public function edit(Trimester $trimester)
    {
        return view('dashboard.trimesters.edit', compact('trimester'));
    }

    public function update(Request $request, Trimester $trimester)
    {
        $this->validate($request, $this->rules());
        $trimester->update($request->input());
        return redirect()->back();
    }

    public function destroy(Trimester $trimester)
    {
        $trimester->delete();
        return redirect()->route('dashboard.trimesters.index');
    }
}
