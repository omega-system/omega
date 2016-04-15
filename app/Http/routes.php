<?php

$this->get('login', ['as' => 'login', 'uses' => 'Auth\AuthController@showLoginForm']);
$this->post('login', 'Auth\AuthController@login');
$this->get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@logout']);

$this->get('/', ['as' => 'home', function () {
    return view('welcome');
}]);
