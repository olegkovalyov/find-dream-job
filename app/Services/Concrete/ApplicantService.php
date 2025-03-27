<?php

namespace App\Services\Concrete;

use App\Http\Requests\Applicant\ApplicantCreateRequest;
use App\Models\Applicant;
use App\Services\Contracts\ApplicantServiceInterface;

class ApplicantService implements ApplicantServiceInterface
{
    public function getApplicantById(int $id): ?Applicant
    {
        return Applicant::find($id);
    }

    public function doesApplicantExist(int $jobId, $userId): bool
    {
        $exist = Applicant::where('job_id', $jobId)
            ->where('user_id', $userId)
            ->exists();
        return $exist;
    }

    public function applyToJob(
        ApplicantCreateRequest $request,
        int $jobId,
        int $userId
    ): void {
        $resumeFileName = '';
        if ($request->hasFile('resume')) {
            $path = $request->file('resume')->store('resumes', 'public');
            $resumeFileName = basename($path);
        }

        Applicant::create([
            'job_id' => $jobId,
            'user_id' => $userId,
            'resume' => $resumeFileName,
            'full_name' => $request->full_name,
            'contact_phone' => $request->contact_phone,
            'contact_email' => $request->contact_email,
            'message' => $request->message,
            'location' => $request->location,
        ]);
    }

    public function delete(int $applicantId): void
    {
        $applicant = Applicant::findOrFail($applicantId);
        $applicant->delete();
    }
}

