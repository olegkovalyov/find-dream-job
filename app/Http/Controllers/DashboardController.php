<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        // Get logged in user
        $user = Auth::user();
        $userId = Auth::user()->getAuthIdentifier();

        // Get the user listings with applicants
        $jobs = Job::where('user_id', $userId)->with('applicants')->get();

        return view('dashboard.index', compact('user', 'jobs'));
    }
}
