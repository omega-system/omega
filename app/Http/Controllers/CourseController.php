<?php

namespace Omega\Http\Controllers;

use Illuminate\Http\Request;
use Omega\Http\Requests;
use Omega\Repositories\CourseRepositoryInterface;

class CourseController extends Controller
{
    /**
     * @var CourseRepositoryInterface
     */
    private $courseRepository;

    /**
     * UserController constructor.
     * @param CourseRepositoryInterface $courseRepository
     */
    public function __construct(CourseRepositoryInterface $courseRepository)
    {
        $this->middleware('permission:create.courses|delete.courses', ['only' => ['index', 'show']]);
        $this->middleware('permission:create.courses', ['only' => ['create', 'store', 'edit', 'update']]);
        $this->middleware('permission:delete.courses', ['only' => 'destroy']);

        $this->courseRepository = $courseRepository;
    }

    public function index()
    {
        $courses = $this->courseRepository->paginate();
        $presenter = app('PaginationPresenter', [$courses]);
        return view('dashboard.course.index', compact('courses', 'presenter'));
    }

    public function create()
    {
        $course = $this->courseRepository->newInstance();
        return view('dashboard.course.create', compact('course'));
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rules());
        $this->courseRepository->create($request->input());
        return redirect()->route('dashboard.course.index');
    }

    /**
     * @param string $course_number
     * @return array
     */
    protected function rules($course_number = '')
    {
        return [
            'course_number' => 'required|unique:courses,course_number,' . $course_number . ',course_number',
            'course_name' => 'required|max:20',
            'credit' => 'required|numeric',
        ];
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $course = $this->courseRepository->getByCourseNumber($id);
        return view('dashboard.course.edit', compact('course'));
    }

    public function update(Request $request, $courseNumber)
    {
        $this->validate($request, $this->rules($courseNumber));
        $course = $this->courseRepository->getByCourseNumber($courseNumber);
        $course->update($request->except(['course_number']));
        return redirect()->route('dashboard.course.edit', $course->course_number);
    }

    public function destroy($id)
    {
        $this->courseRepository->getByCourseNumber($id)->delete();
        return redirect()->route('dashboard.course.index');
    }
}
