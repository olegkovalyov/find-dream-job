<?php

namespace App\Services\Contracts;

use App\Http\Requests\Applicant\ApplicantCreateRequest;
use App\Models\Applicant;

interface ApplicantServiceInterface
{
    public function getApplicantById(int $id): ?Applicant;

    public function doesApplicantExist(int $jobId, $userId): bool;

    public function applyToJob(
        ApplicantCreateRequest $request,
        int $jobId,
        int $userId
    ): void;

    public function delete(int $applicantId): void;
}
