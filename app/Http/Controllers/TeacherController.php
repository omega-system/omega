<?php

namespace Omega\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Omega\CourseClass;
use Omega\Trimester;

class TeacherController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function showClasses(Request $request)
    {
        $trimesters = Trimester::all();

        $current_trimester = Trimester::find($request->get('trimester')) ?:
            get_current_trimester(Trimester::firstOrFail());

        $classes = $this->user->courseClasses()
            ->whereTrimesterId($current_trimester->id)
            ->get();

        return view('dashboard.teacher.classes.index', compact('trimesters', 'current_trimester', 'classes'));
    }

    public function showEnrollments(CourseClass $class)
    {
        $class = $this->user->courseClasses()
            ->with('course')
            ->with('enrollments')
            ->findOrFail($class->id);

        $enrollments = $class->enrollments;

        return view('dashboard.teacher.classes.enrollments', compact('class', 'enrollments'));
    }
}
