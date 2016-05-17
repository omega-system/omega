<?php

namespace Omega\Http\Controllers;

use Bican\Roles\Models\Role;
use Illuminate\Http\Request;
use Omega\Course;
use Omega\CourseClass;
use Omega\Http\Requests;
use Omega\Trimester;

class CourseClassController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:create.classes|delete.classes', ['only' => ['index', 'show']]);
        $this->middleware('permission:create.classes', ['only' => ['create', 'store', 'edit', 'update']]);
        $this->middleware('permission:delete.classes', ['only' => 'destroy']);
    }

    public function index()
    {
        $classes = CourseClass::paginate();
        $presenter = app('PaginationPresenter', [$classes]);
        return view('dashboard.classes.index', compact('classes', 'presenter'));
    }

    public function create(CourseClass $class)
    {
        $trimesters = Trimester::allDesc();
        $courses = Course::all();
        $teachers = Role::whereSlug('teacher')->firstOrFail()->users;
        return view('dashboard.classes.create', compact('class', 'trimesters', 'courses', 'teachers'));
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rules());
        CourseClass::create($request->input());
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
            'location' => 'required',
            'score_a_percent' => 'required|integer|min:0|max:100'
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

    public function edit(CourseClass $class)
    {
        $trimesters = Trimester::allDesc();
        $courses = Course::all();
        $teachers = Role::whereSlug('teacher')->firstOrFail()->users;
        return view('dashboard.classes.edit', compact('class', 'trimesters', 'courses', 'teachers'));
    }

    public function update(Request $request, CourseClass $class)
    {
        $this->validate($request, $this->rules($class->id));
        $class->update($request->input());
        return redirect()->back();
    }

    public function destroy(CourseClass $class)
    {
        $class->delete();
        return redirect()->route('dashboard.classes.index');
    }
}
