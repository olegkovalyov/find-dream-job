<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BookmarkController extends Controller
{

    public function index(): View
    {
        $user = Auth::user();

        $bookmarks = $user->bookmarkedJobs()->orderBy('job_user_bookmarks.created_at', 'desc')->paginate(6);
        return view('jobs.bookmarked')->with('bookmarks', $bookmarks);
    }

    public function store(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $jobId = (int) $request->input('jobId');
        $job = Job::find($jobId);

        if (!$job) {
            return back()->with('error', 'Job is unavailable');
        }

        // Check if the job is already bookmarked
        if ($user->bookmarkedJobs()->where('job_id', $job->id)->exists()) {
            return back()->with('error', 'Job is already bookmarked');
        }

        // Create new bookmark
        $user->bookmarkedJobs()->attach($job->id);

        return back()->with('success', 'Job bookmarked successfully!');
    }
}
