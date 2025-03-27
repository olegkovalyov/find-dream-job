<?php

namespace App\Http\Controllers;

use App\Http\Requests\Bookmark\BookmarkCreateRequest;
use App\Models\Job;
use App\Services\Contracts\BookmarkServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BookmarkController extends Controller
{
    public function __construct(
        private readonly BookmarkServiceInterface $bookmarkService
    ) {
    }

    public function index(): View
    {
        $bookmarks = $this->bookmarkService->loadBookmarksForDashboard();
        return view('jobs.bookmarked')->with('bookmarks', $bookmarks);
    }

    public function store(BookmarkCreateRequest $request): RedirectResponse
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


    public function destroy(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $jobId = (int) $request->input('jobId');
        $job = Job::find($jobId);

        if (!$job) {
            return back()->with('error', 'Job is unavailable');
        }

        // Check if the job is not bookmarked
        if (!$user->bookmarkedJobs()->where('job_id', $job->id)->exists()) {
            return back()->with('error', 'Job is not bookmarked');
        }

        // Remove bookmark
        $user->bookmarkedJobs()->detach($job->id);

        return back()->with('success', 'Bookmark removed successfully!');
    }
}
