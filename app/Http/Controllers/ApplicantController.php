<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\Request;
use App\Models\Job;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ApplicantController extends Controller
{

    public function store(Request $request, Job $job): RedirectResponse
    {
        // Validate incoming data
        $validatedData = $request->validate([
            'full_name' => 'required|string',
            'contact_phone' => 'string',
            'contact_email' => 'required|string|email',
            'message' => 'string',
            'location' => 'string',
            'resume' => 'required|file|mimes:pdf|max:2048',
        ]);

        // Handle resume uplaod
        if ($request->hasFile('resume')) {
            $path = $request->file('resume')->store('resumes', 'public');
            $validatedData['resume'] = basename($path);
        }

        // Store the application
        $application = new Applicant($validatedData);
        $application->job_id = $job->id;
        $application->user_id = auth()->id();
        $application->save();

        return redirect()->back()->with('success', 'Your application has been submitted');
    }

    public function download(int $applicantId): RedirectResponse | StreamedResponse
    {
        $applicant = Applicant::find($applicantId);
        if (!$applicantId) {
            return redirect()->back()->with('error', 'Failed to download resume');
        }
        return Storage::download('/resumes/'.$applicant->resume);
    }
}
