<?php

namespace Omega\Http\Controllers;

use Omega\System;
use Symfony\Component\HttpFoundation\Request;

class SystemController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index(System $system)
    {
        return view('dashboard.system.index', compact('system'));
    }

    public function store(System $system, Request $request)
    {
        $system->allowEnrollment($request->get('allow_enrollment', false));
        $system->allowWithdrawal($request->get('allow_withdrawal', false));
        $system->allowScoreUpdate($request->get('allow_score_update', false));

        return redirect()->back();
    }
}
