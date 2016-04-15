<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the ioncontroller to call when that URI is requested.
|
*/

// Secure test
Route::get('secure', function () {
    return ['secure' => Request::secure()];
});

Route::get('/', function () {
    return view('welcome');
});

// Authentication
$this->get('login', 'Auth\AuthController@showLoginForm');
$this->post('login', 'Auth\AuthController@login');
$this->get('logout', 'Auth\AuthController@logout');

Route::get('/home', 'HomeController@index');
