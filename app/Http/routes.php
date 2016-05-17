<?php
Route::get('login', ['as' => 'login', 'uses' => 'Auth\AuthController@showLoginForm']);
Route::post('login', 'Auth\AuthController@login');
Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@logout']);

Route::get('/', ['as' => 'index', 'middleware' => ['guest'], function () {
    return view('index');
}]);

Route::get('dashboard', ['as' => 'dashboard.index', 'uses' => 'DashboardController@index']);

Route::get('system', ['as' => 'dashboard.system.index', 'uses' => 'SystemController@index']);
Route::put('system', ['as' => 'dashboard.system.store', 'uses' => 'SystemController@store']);
Route::resource('users', 'UserController', ['as' => 'dashboard']);
Route::resource('trimesters', 'TrimesterController', ['as' => 'dashboard']);
Route::get('trimesters/{trimester}/set_as_current',
    ['as' => 'dashboard.trimesters.set_as_current', 'uses' => 'TrimesterController@setAsCurrent']);
Route::resource('courses', 'CourseController', ['as' => 'dashboard']);
Route::resource('classes', 'CourseClassController', ['as' => 'dashboard']);

Route::get('teacher/classes', ['as' => 'dashboard.teacher.classes.index',
    'uses' => 'TeacherController@showClasses']);
Route::get('teacher/classes/{class}/enrollments', ['as' => 'dashboard.teacher.classes.enrollments',
    'uses' => 'TeacherController@showEnrollments']);
Route::get('teacher/classes/{class}/score_update', ['as' => 'dashboard.teacher.classes.score_update',
    'uses' => 'TeacherController@updateScore']);
Route::put('teacher/classes/{class}/score_update', ['as' => 'dashboard.teacher.classes.score_update',
    'uses' => 'TeacherController@storeScore']);
