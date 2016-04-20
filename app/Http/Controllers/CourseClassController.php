<?php

namespace Omega\Http\Controllers;

use Illuminate\Http\Request;
use Omega\Http\Requests;
use Omega\Repositories\TrimesterRepositoryInterface;

class CourseClassController extends Controller
{
    /**
     * @var CourseClassRepositoryInterface
     */
    private $courseClassRepository;

    /**
     * UserController constructor.
     * @param CourseClassRepositoryInterface $courseClassRepository
     */
    public function __construct(CourseClassRepositoryInterface $courseClassRepository)
    {
        $this->middleware('permission:create.classes|delete.classes', ['only' => ['index', 'show']]);
        $this->middleware('permission:create.classes', ['only' => ['create', 'store', 'edit', 'update']]);
        $this->middleware('permission:delete.classes', ['only' => 'destroy']);

        $this->courseClassRepository = $courseClassRepository;
    }

    public function index()
    {
        $classes = $this->courseClassRepository->paginate();
        $presenter = app('PaginationPresenter', [$classes]);
        return view('dashboard.class.index', compact('classes', 'presenter'));
    }

    public function create()
    {
        $courseClass = $this->courseClassRepository->new();
        return view('dashboard.class.create', compact('courseClass'));
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rules());
        $this->courseClassRepository->create($request->input());
        return redirect()->route('dashboard.class.index');
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
        $class = $this->courseClassRepository->getById($id);
        return view('dashboard.class.edit', compact('class'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, $this->rules());
        $class = $this->courseClassRepository->getById($id);
        $class->update($request->input());
        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->courseClassRepository->getById($id)->delete();
        return redirect()->route('dashboard.class.index');
    }
}
