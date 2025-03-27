<?php

namespace App\Services\Contracts;

use App\Http\Requests\Job\JobStoreRequest;
use App\Http\Requests\Job\JobUpdateRequest;
use App\Models\Job;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface JobServiceInterface
{
    public function loadForHomePage(): Collection;

    public function loadLatest(): LengthAwarePaginator;

    public function loadJobsForUserWithApplicants(int $userId): Collection;

    public function create(JobStoreRequest $request): void;

    public function update(JobUpdateRequest $request, Job $job): void;

    public function delete(Job $job): void;

    public function search(string $location, string $keywords): LengthAwarePaginator;
}
