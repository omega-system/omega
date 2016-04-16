<?php

namespace Omega\Http\Controllers;

use Omega\Http\Requests;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('dashboard.index');
    }
}
