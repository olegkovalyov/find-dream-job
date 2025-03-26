<?php

namespace App\Services\Concrete;

use App\Http\Requests\JobStoreRequest;
use App\Http\Requests\JobUpdateRequest;
use App\Models\Job;
use App\Services\Contracts\JobServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JobService implements JobServiceInterface
{
    /**
     * @return Job[]
     */
    public function loadLatest(): LengthAwarePaginator
    {
        return Job::latest()->paginate(9);
    }

    public function create(JobStoreRequest $request): void
    {
        $companyLogo = '';
        if ($request->hasFile('company_logo')) {
            $path = $request->file('company_logo')->store('company-logos', 'public');
            $companyLogo = basename($path);
        }

        Job::create([
            'user_id' => Auth::user()->getAuthIdentifier(),
            'title' => $request->title,
            'description' => $request->description,
            'salary' => $request->salary,
            'tags' => $request->tags,
            'job_type' => $request->job_type,
            'remote' => $request->remote,
            'requirements' => $request->requirements,
            'benefits' => $request->benefits,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zipcode' => $request->zipcode,
            'contact_email' => $request->contact_email,
            'contact_phone' => $request->contact_phone,
            'company_name' => $request->company_name,
            'company_description' => $request->company_description,
            'company_website' => $request->company_website,
            'company_logo' => $companyLogo
        ]);
    }

    public function update(JobUpdateRequest $request, Job $job): void
    {
        $companyLogo = '';
        if ($request->hasFile('company_logo')) {
            Storage::disk('local')->delete('company-logos/'.$job->company_logo);
            $path = $request->file('company_logo')->store('company-logos', 'public');
            $companyLogo = basename($path);
        }

        $job->update([
            'user_id' => Auth::user()->getAuthIdentifier(),
            'title' => $request->title,
            'description' => $request->description,
            'salary' => $request->salary,
            'tags' => $request->tags,
            'job_type' => $request->job_type,
            'remote' => $request->remote,
            'requirements' => $request->requirements,
            'benefits' => $request->benefits,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zipcode' => $request->zipcode,
            'contact_email' => $request->contact_email,
            'contact_phone' => $request->contact_phone,
            'company_name' => $request->company_name,
            'company_description' => $request->company_description,
            'company_website' => $request->company_website,
            'company_logo' => $companyLogo
        ]);
    }

    public function delete(Job $job): void
    {
        if ($job->company_logo) {
            $path = '/company-logos/'.$job->company_logo;
            Storage::disk('local')->delete($path);
        }
        $job->delete();
    }
}
