<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobStoreRequest;
use App\Http\Requests\JobUpdateRequest;
use App\Models\Job;
use App\Services\Contracts\JobServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class JobController extends Controller
{
    public function __construct(
        private readonly JobServiceInterface $jobService
    ) {
    }

    public function index(): View
    {
        $jobs = $this->jobService->loadLatest();
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

    public function show(Job $job): View
    {
        return view('jobs.show', compact('job'));
    }

    public function store(JobStoreRequest $request): RedirectResponse
    {
        $this->jobService->create($request);

        return redirect()->route('dashboard.index')
            ->with('success', 'Job listing created successfully!');
    }

    public function edit(Job $job): View|RedirectResponse
    {
        if (!$this->isAllowedForAction($job->user_id)) {
            return redirect()->route('jobs.index')
                ->with('error', 'You have no access');
        }
        return view('jobs.edit', compact('job'));
    }

    public function update(JobUpdateRequest $request, Job $job): string
    {
        if (!$this->isAllowedForAction($job->user_id)) {
            return redirect()->route('jobs.index')
                ->with('error', 'You have no access');
        }
        $this->jobService->update($request, $job);
        return redirect()->route('dashboard.index')
            ->with('success', 'Job listing updated successfully!');
    }

    public function destroy(Job $job): RedirectResponse
    {
        if (!$this->isAllowedForAction($job->user_id)) {
            return redirect()->route('jobs.index')
                ->with('error', 'You have no access');
        }

        $this->jobService->delete($job);
        if (request()->query('from') == 'dashboard') {
            return redirect()->route('dashboard')
                ->with('success', 'Job listing deleted successfully!');
        }

        return redirect()->route('jobs.index')
            ->with('success', 'Job listing deleted successfully!');
    }


    public function search(Request $request): View
    {
        $keywords = strtolower($request->input('keywords'));
        $location = strtolower($request->input('location'));

        $query = Job::query();

        if ($keywords) {
            $query->where(function ($q) use ($keywords) {
                $q->whereRaw('LOWER(title) like ?', ['%'.$keywords.'%'])
                    ->orWhereRaw('LOWER(description) like ?', ['%'.$keywords.'%'])
                    ->orWhereRaw('LOWER(tags) like ?', ['%'.$keywords.'%']);
            });
        }

        if ($location) {
            $query->where(function ($q) use ($location) {
                $q->whereRaw('LOWER(address) like ?', ['%'.$location.'%'])
                    ->orWhereRaw('LOWER(city) like ?', ['%'.$location.'%'])
                    ->orWhereRaw('LOWER(state) like ?', ['%'.$location.'%'])
                    ->orWhereRaw('LOWER(zipcode) like ?', ['%'.$location.'%']);
            });
        }

        $jobs = $query->paginate(9);

        return view('jobs.index')->with('jobs', $jobs);
    }

    protected function isAllowedForAction(int $userId): bool
    {
        return Auth::user()->getAuthIdentifier() === $userId;
    }
}
