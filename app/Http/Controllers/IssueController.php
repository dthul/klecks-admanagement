<?php

namespace App\Http\Controllers;

use App\Issue;

class IssueController extends Controller
{
    public function showIssues()
    {
        return view('issues.index', ['issues' => Issue::all()]);
    }
}
