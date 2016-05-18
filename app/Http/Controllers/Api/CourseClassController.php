<?php

namespace Omega\Http\Controllers\Api;

use Illuminate\Http\Request;
use Omega\Http\Controllers\Controller;

class CourseClassController extends Controller
{
    public function query(Request $request)
    {
        $current_trimester = get_current_trimester();

        if (!$current_trimester) {
            return ['success' => false];
        }

        $classes = $current_trimester
            ->courseClasses()
            ->join('users', 'users.id', '=', 'teacher_id')
            ->join('courses', 'courses.course_number', '=', 'course_classes.course_number')
            ->select('course_classes.id', 'course_classes.course_number',
                'course_name', 'class_number', 'location', 'name AS teacher')
            ->where('course_classes.course_number', 'LIKE', '%' . $request->get('course_number') . '%')
            ->where('course_name', 'LIKE', '%' . $request->get('course_name') . '%')
            ->get();

        return ['success' => true, 'items' => $classes->toArray()];
    }
}
