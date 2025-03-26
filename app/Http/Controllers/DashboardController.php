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

        // Get the user listings
        $jobs = Job::where('user_id', $userId)->get();

        return view('dashboard.index', compact('user', 'jobs'));
    }
}
