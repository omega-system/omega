<?php
$this->get('login', ['as' => 'login', 'uses' => 'Auth\AuthController@showLoginForm']);
$this->post('login', 'Auth\AuthController@login');
$this->get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@logout']);

$this->get('/', ['as' => 'index', 'middleware' => ['guest'], function () {
    return view('index');
}]);

$this->get('dashboard', ['as' => 'dashboard.index', 'uses' => 'DashboardController@index']);
$this->resource('user', 'UserController', ['as' => 'dashboard']);
$this->resource('trimester', 'TrimesterController', ['as' => 'dashboard']);
