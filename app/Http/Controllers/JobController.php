<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class JobController extends Controller
{
    public function index(): View
    {
        $jobs = [
            'Web Developer',
            'Database Admin',
            'Software Engineer',
            'Systems Analyst'
        ];

        return view('jobs.index', compact('jobs'));
    }

    public function create(): View
    {
        return view('jobs.create');
    }

    public function saved(): View
    {
        return view('jobs.saved');
    }
}
