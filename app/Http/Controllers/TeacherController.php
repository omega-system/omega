<?php

namespace Omega\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Omega\CourseClass;
use Omega\System;
use Omega\Trimester;

class TeacherController extends Controller
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

        $classes = $this->user->courseClasses()
            ->whereTrimesterId($current_trimester->id)
            ->get();

        return view('dashboard.teacher.classes.index', compact('system', 'trimesters', 'current_trimester', 'classes'));
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

    public function updateScore(CourseClass $class)
    {
        $class = $this->user->courseClasses()
            ->with('course')
            ->with('enrollments')
            ->findOrFail($class->id);

        $enrollments = $class->enrollments;

        return view('dashboard.teacher.classes.score_update', compact('class', 'enrollments'));
    }

    public function storeScore(CourseClass $class, Request $request)
    {
        $class = $this->user->courseClasses()
            ->with('course')
            ->with('enrollments')
            ->findOrFail($class->id);

        $enrollments = $class->enrollments;

        $this->validate($request, [
            'score_a.*' => 'required|integer|min:0|max:100',
            'score_b.*' => 'required|integer|min:0|max:100'
        ]);

        $score_a_list = $request->input('score_a');
        $score_b_list = $request->input('score_b');

        foreach ($enrollments as $enrollment) {
            $enrollment->update([
                'score_a' => current($score_a_list),
                'score_b' => current($score_b_list)
            ]);
            next($score_a_list);
            next($score_b_list);
        }

        return redirect()->back();
    }
}
