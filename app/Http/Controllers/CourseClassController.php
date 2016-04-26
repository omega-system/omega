<?php

namespace Omega\Http\Controllers;

use Illuminate\Http\Request;
use Omega\Http\Requests;
use Omega\Repositories\CourseClassRepositoryInterface;
use Omega\Repositories\CourseRepositoryInterface;
use Omega\Repositories\RoleRepositoryInterface;
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
        return view('dashboard.classes.index', compact('classes', 'presenter'));
    }

    public function create(TrimesterRepositoryInterface $trimesterRepository,
                           CourseRepositoryInterface $courseRepository,
                           RoleRepositoryInterface $roleRepository)
    {
        $class = $this->courseClassRepository->newInstance();
        $trimesters = $trimesterRepository->getAllDesc();
        $courses = $courseRepository->getAll();
        $teachers = $roleRepository->getBySlug('teacher')->users;
        return view('dashboard.classes.create', compact('class', 'trimesters', 'courses', 'teachers'));
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rules());
        $this->courseClassRepository->create($request->input());
        return redirect()->route('dashboard.classes.index');
    }

    /**
     * @param string $id
     * @return array
     */
    protected function rules($id = '')
    {
        $rules = [
            'trimester_id' => 'required|exists:trimesters,id',
            'course_number' => 'required|exists:courses',
            'class_number' => 'required|digits:4|unique_with:course_classes,trimester_id,course_number',
            'teacher_id' => 'required|exists:users,id',
        ];

        /*
         * ignore the current id
         * if a user is editing a class
         */
        if (!empty($id)) {
            $rules['class_number'] .= ',' . $id;
        }

        return $rules;
    }

    public function show($id)
    {
        //
    }

    public function edit(TrimesterRepositoryInterface $trimesterRepository,
                         CourseRepositoryInterface $courseRepository,
                         RoleRepositoryInterface $roleRepository,
                         $id)
    {
        $class = $this->courseClassRepository->getById($id);
        $trimesters = $trimesterRepository->getAllDesc();
        $courses = $courseRepository->getAll();
        $teachers = $roleRepository->getBySlug('teacher')->users;
        return view('dashboard.classes.edit', compact('class', 'trimesters', 'courses', 'teachers'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, $this->rules($id));
        $class = $this->courseClassRepository->getById($id);
        $class->update($request->input());
        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->courseClassRepository->getById($id)->delete();
        return redirect()->route('dashboard.classes.index');
    }
}
