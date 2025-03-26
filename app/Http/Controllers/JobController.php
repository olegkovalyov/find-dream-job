<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class JobController extends Controller
{
    public function index(): View
    {
        $jobs = Job::paginate(6);

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

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'required|integer',
            'tags' => 'nullable|string',
            'job_type' => 'required|string',
            'remote' => 'required|boolean',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zipcode' => 'nullable|string',
            'contact_email' => 'required|string',
            'contact_phone' => 'nullable|string',
            'company_name' => 'required|string',
            'company_description' => 'nullable|string',
            'company_logo' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
            'company_website' => 'nullable|url'
        ]);

        // Hardcoded user ID
        $validatedData['user_id'] = Auth::user()->getAuthIdentifier();

        if ($request->hasFile('company_logo')) {
            // Store the file and get path
            $path = $request->file('company_logo')->store('company-logos', 'public');
            // Add path to validated data
            $validatedData['company_logo'] = basename($path);
        }

        Job::create($validatedData);

        return redirect()->route('dashboard.index')
            ->with('success', 'Job listing created successfully!');
    }

    public function edit(Job $job): View | RedirectResponse
    {
        if (Auth::user()->getAuthIdentifier() !== $job->user_id) {
            return redirect()->route('jobs.index')->with('error', 'You have no access');
        }

        return view('jobs.edit', compact('job'));
    }

    public function update(Request $request, Job $job): string
    {
        if (Auth::user()->getAuthIdentifier() !== $job->user_id) {
            return redirect()->route('jobs.index')->with('error', 'You have no access');
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'required|integer',
            'tags' => 'nullable|string',
            'job_type' => 'required|string',
            'remote' => 'required|boolean',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zipcode' => 'nullable|string',
            'contact_email' => 'required|string',
            'contact_phone' => 'nullable|string',
            'company_name' => 'required|string',
            'company_description' => 'nullable|string',
            'company_logo' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
            'company_website' => 'nullable|url'
        ]);

        // Check for image
        if ($request->hasFile('company_logo')) {
            // Delete old logo
            Storage::disk('local')->delete('company-logos/'.$job->company_logo);

            // Store the file and get path
            $path = $request->file('company_logo')->store('company-logos', 'public');

            // Add path to validated data
            $validatedData['company_logo'] = basename($path);
        }

        // Submit to database
        $job->update($validatedData);

        return redirect()->route('dashboard.index')->with('success', 'Job listing updated successfully!');
    }

    public function destroy(Job $job): RedirectResponse
    {
        if ($job->company_logo) {
            $path = '/company-logos/'.$job->company_logo;
            Storage::disk('local')->delete($path);
        }

        $job->delete();

        // Check if request came from the dashboard
        if (request()->query('from') == 'dashboard') {
            return redirect()->route('dashboard')->with('success', 'Job listing deleted successfully!');
        }

        return redirect()->route('jobs.index')->with('success', 'Job listing deleted successfully!');
    }
}
