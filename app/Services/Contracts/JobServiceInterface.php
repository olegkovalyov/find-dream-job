<?php

namespace App\Services\Contracts;

use App\Http\Requests\JobStoreRequest;
use App\Http\Requests\JobUpdateRequest;
use App\Models\Job;
use Illuminate\Pagination\LengthAwarePaginator;

interface JobServiceInterface
{
    public function loadLatest(): LengthAwarePaginator;

    public function create(JobStoreRequest $request): void;

    public function update(JobUpdateRequest $request, Job $job): void;

    public function delete(Job $job): void;
}
