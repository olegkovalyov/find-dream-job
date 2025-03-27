<?php

namespace App\Http\Controllers;

use App\Services\Contracts\JobServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(
        private readonly JobServiceInterface $jobService
    ) {
    }

    public function index(): View
    {
        $user = Auth::getUser();
        $jobs = $this->jobService->loadJobsForUserWithApplicants($user->getAuthIdentifier());
        return view('dashboard.index', compact('user', 'jobs'));
    }
}
