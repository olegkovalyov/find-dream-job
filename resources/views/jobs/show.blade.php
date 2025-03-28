<x-layout>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <section class="md:col-span-3">
            <div class="rounded-lg shadow-md bg-white p-3">
                <div class="flex justify-between items-center">
                    <a class="block p-4 text-blue-700" href="{{route('jobs.index')}}">
                        <i class="fa fa-arrow-alt-circle-left"></i>
                        Back To Listings
                    </a>
                    @if(auth()->user()->getAuthIdentifier() === $job->user_id)
                        <div class="flex space-x-3 ml-4">
                            <a href="{{route('jobs.edit', $job->id)}}"
                               class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded">
                                Edit
                            </a>
                            <!-- Delete Form -->
                            <form method="POST" action="{{route('jobs.destroy', $job->id)}}"
                                  onsubmit="return confirm('Are you sure that you want to delete this job?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded">
                                    Delete
                                </button>
                            </form>
                            <!-- End Delete Form -->
                        </div>
                    @endif
                </div>
                <div class="p-4">
                    <h2 class="text-xl font-semibold">
                        {{$job->title}}
                    </h2>
                    <p class="text-gray-700 text-lg mt-2">
                        {{$job->description}}
                    </p>
                    <ul class="my-4 bg-gray-100 p-4">
                        <li class="mb-2">
                            <strong>Job Type:</strong> {{$job->job_type}}
                        </li>
                        <li class="mb-2">
                            <strong>Remote:</strong> {{$job->remote ? 'Yes' : 'No'}}
                        </li>
                        <li class="mb-2">
                            <strong>Salary:</strong> ${{number_format($job->salary)}}
                        </li>
                        <li class="mb-2">
                            <strong>Site Location:</strong> {{$job->city}}, {{$job->state}}
                        </li>
                        @if($job->tags)
                            <li class="mb-2">
                                <strong>Tags:</strong> {{ucwords(str_replace(',', ', ', $job->tags))}}
                            </li>
                        @endif
                    </ul>
                </div>
            </div>

            <div class="container mx-auto p-4">
                <h2 class="text-xl font-semibold mb-4">Job Details</h2>
                <div class="rounded-lg shadow-md bg-white p-4">
                    @if($job->requirements)
                        <h3 class="text-lg font-semibold mb-2 text-blue-500">
                            Job Requirements
                        </h3>
                        <p>
                            {{$job->requirements}}
                        </p>
                    @endif
                    @if($job->benebits)
                        <h3 class="text-lg font-semibold mt-4 mb-2 text-blue-500">
                            Job Benefits
                        </h3>
                        <p>
                            {{$job->benefits}}
                        </p>
                    @endif
                </div>
                <p class="my-5">
                    Put "Job Application" as the subject of your email
                    and attach your resume.
                </p>
                <x-applicant-form :job="$job" />
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md mt-6">
                <div id="map"></div>
            </div>
        </section>

        <aside class="bg-white rounded-lg shadow-md p-3">
            <h3 class="text-xl text-center mb-4 font-bold">
                Company Info
            </h3>
            @if($job->company_logo)
                <img src="/images/company-logos/{{$job->company_logo}}" alt="Ad" class="w-full rounded-lg mb-4 m-auto"/>
            @endif
            <h4 class="text-lg font-bold">{{$job->company_name}}</h4>
            @if($job->company_description)
                <p class="text-gray-700 text-lg my-3">
                    {{$job->company_description}}
                </p>
            @endif
            @if($job->company_website)
                <a href="{{$job->company_website}}" target="_blank" class="text-blue-500">Visit Website</a>
            @endif
            <form method="POST"
                  action="{{auth()->user()->bookmarkedJobs()->where('job_id', $job->id)->exists() ? route('bookmarks.destroy') : route('bookmarks.store')}}"
                  class="mt-10">
                @csrf
                <input type="hidden" name="jobId" value="{{$job->id}}">
                @if(auth()->user()->bookmarkedJobs()->where('job_id', $job->id)->exists())
                    @method('DELETE')
                    <button
                        class="cursor-pointer bg-red-500 hover:bg-red-600 text-white font-bold w-full py-2 px-4 rounded-full flex items-center justify-center">
                        <i class="fas fa-bookmark mr-3"></i> Remove Bookmark
                    </button>
                @else
                    <button
                        class="cursor-pointer bg-green-500 hover:bg-green-600 text-white font-bold w-full py-2 px-4 rounded-full flex items-center justify-center">
                        <i class="fas fa-bookmark mr-3"></i> Bookmark Listing
                    </button>
                @endif
            </form>
        </aside>
    </div>
</x-layout>
<x-mapbox :job="$job" />
