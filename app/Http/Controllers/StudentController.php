<?php

namespace Omega\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Omega\CourseClass;
use Omega\CourseEnrollment;
use Omega\Exceptions\CurrentTimesterNotSetException;
use Omega\Http\Requests;
use Omega\System;
use Omega\Trimester;

class StudentController extends Controller
{

    private $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function showClasses(Request $request, System $system)
    {
        $trimesters = Trimester::all();

        $current_trimester = Trimester::find($request->get('trimester')) ?:
            get_current_trimester(Trimester::firstOrFail());

        $enrollments = $this->user->enrollments()
            ->whereHas('courseClass', function ($query) use ($current_trimester) {
                $query->where('trimester_id', $current_trimester->id);
            })
            ->get();

        return view('dashboard.student.classes', compact('system', 'trimesters', 'current_trimester', 'enrollments'));
    }

    public function enrollment()
    {
        $current_trimester = get_current_trimester();

        if (!$current_trimester) {
            throw new CurrentTimesterNotSetException;
        }

        $enrollments = $this->user->enrollments()
            ->whereHas('courseClass', function ($query) use ($current_trimester) {
                $query->where('trimester_id', $current_trimester->id);
            })
            ->get();

        return view('dashboard.student.enrollments', compact('current_trimester', 'enrollments'));
    }

    public function enroll($class_id)
    {
        if ($this->user->enrollments()->whereCourseClassId($class_id)->count() === 0) {
            CourseEnrollment::create([
                'user_id' => $this->user->id,
                'course_class_id' => $class_id
            ]);
        }

        return redirect()->back();
    }

    public function withdraw($class_id)
    {
        $enrollment = $this->user->enrollments()->whereCourseClassId($class_id)->firstOrFail();

        $enrollment->delete();

        return redirect()->back();
    }
}
