<?php

namespace App\Services\Concrete;

use App\Http\Requests\Job\JobStoreRequest;
use App\Http\Requests\Job\JobUpdateRequest;
use App\Models\Job;
use App\Services\Contracts\JobServiceInterface;
use Illuminate\Database\Eloquent\Collection;
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

    /**
     * @return Collection
     */
    public function loadForHomePage(): Collection
    {
        return Job::latest()->limit(6)->get();
    }

    /**
     * @param  int  $userId
     * @return Collection
     */
    public function loadJobsForUserWithApplicants(int $userId): Collection
    {
        $jobs = Job::where('user_id', $userId)
            ->with('applicants')
            ->get();
        return $jobs;
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

    public function search(string $location, string $keywords): LengthAwarePaginator
    {
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

        return $query->paginate(9);
    }
}
