<?php

namespace App\Http\Controllers;

use App\Http\Requests\Applicant\ApplicantCreateRequest;
use App\Models\Job;
use App\Services\Contracts\ApplicantServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ApplicantController extends Controller
{
    public function __construct(
        private readonly ApplicantServiceInterface $applicantService
    ) {
    }

    public function store(ApplicantCreateRequest $request, Job $job): RedirectResponse
    {
        if ($this->applicantService->doesApplicantExist($job->id, auth()->id())) {
            return redirect()->back()
                ->with('error', 'You have already applied to this job');
        }

        $this->applicantService->applyToJob(
            request: $request,
            jobId: $job->id,
            userId: auth()->id()
        );

        return redirect()->back()
            ->with('success', 'You successfully applied to this job');
    }

    public function destroy($id): RedirectResponse
    {
        $this->applicantService->delete($id);
        return redirect()->route('dashboard.index')
            ->with('success', 'Applicant deleted successfully!');
    }

    public function download(int $applicantId): RedirectResponse|StreamedResponse
    {
        $applicant = $this->applicantService->getApplicantById($applicantId);
        if (!$applicant) {
            return redirect()->back()->with('error', 'Failed to download resume');
        }
        return Storage::download('/resumes/'.$applicant->resume);
    }
}
