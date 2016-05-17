<?php

namespace Omega\Http\Controllers;

use Illuminate\Http\Request;
use Omega\Course;
use Omega\Http\Requests;

class CourseController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:create.courses|delete.courses', ['only' => ['index', 'show']]);
        $this->middleware('permission:create.courses', ['only' => ['create', 'store', 'edit', 'update']]);
        $this->middleware('permission:delete.courses', ['only' => 'destroy']);
    }

    public function index()
    {
        $courses = Course::paginate();
        $presenter = app('PaginationPresenter', [$courses]);
        return view('dashboard.courses.index', compact('courses', 'presenter'));
    }

    public function create(Course $course)
    {
        return view('dashboard.courses.create', compact('course'));
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rules());
        Course::create($request->input());
        return redirect()->route('dashboard.courses.index');
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

    public function edit(Course $course)
    {
        return view('dashboard.courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $this->validate($request, $this->rules($course->course_number));
        $course->update($request->except(['course_number']));
        return redirect()->route('dashboard.courses.edit', $course->course_number);
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('dashboard.courses.index');
    }
}
