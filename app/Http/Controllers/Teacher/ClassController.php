<?php

namespace Omega\Http\Controllers\Teacher;

use Auth;
use Illuminate\Http\Request;

use Omega\CourseClassTime;
use Omega\Http\Requests;
use Omega\Http\Controllers\Controller;
use Omega\Course;
class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        //$classes = $user->courseClasses->where('id', 2);

        //return $classes;
        $classes=$user->courseClasses;
        //return $user->courseClasses;

        return view('dashboard.teachers.index', compact('classes'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();

        $class = $user->courseClasses()
            ->with('enrollments')
            ->with('enrollments.student')
            ->where('id', $id)->firstOrFail();

        $enrollments = $class->enrollments;

        return view('dashboard.teachers.show', compact('class', 'enrollments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = Auth::user();

        $class = $user->courseClasses->where('id', $id)->firstOrFail();

        return view('dashboard.teachers.edit', compact('class'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

    }
}
