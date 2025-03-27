<x-layout>
    <section class="flex flex-col md:flex-row gap-4">
        {{-- Profile Info Form --}}
        <div class="bg-white p-8 rounded-lg shadow-md w-full">
            <h3 class="text-3xl text-center font-bold mb-4">
                Profile Info
            </h3>

            @if($user->avatar)
                <div class="mt-2 flex justify-center">
                    <img src="/images/avatars/{{ Auth::user()->avatar }}" alt="{{$user->name}}"
                         class="w-24 h-24 object-cover rounded-full">
                </div>
            @endif

            <form method="POST" action="{{route('profile.update')}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <x-form.text id="name" name="name" label="Name" value="{{$user->name}}" />
                <x-form.text id="email" name="email" label="Email address" type="email" value="{{$user->email}}" />

                <x-form.file id="avatar" name="avatar" label="Upload Avatar" />

                <button type="submit"
                        class="cursor-pointer w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 border rounded focus:outline-none">Save</button>
            </form>
        </div>

        {{-- Job Listings --}}
        <div class="bg-white p-8 rounded-lg shadow-md w-full">
            <h3 class="text-3xl text-center font-bold mb-4">
                My Job Listings
            </h3>
            @forelse($jobs as $job)
                <div class="flex justify-between items-center border-b-2 border-gray-200 py-2">
                    <div>
                        <h3 class="text-xl font-semibold">{{$job->title}}</h3>
                        <p class="text-gray-700">{{$job->job_type}}</p>
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{route('jobs.edit', $job->id)}}" class="bg-blue-500 text-white px-4 py-2 rounded text-sm">Edit</a>
                        <!-- Delete Form -->
                        <form method="POST" action="{{route('jobs.destroy', $job->id)}}?from=dashboard"
                              onsubmit="return confirm('Are you sure that you want to delete this job?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="cursor-pointer px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded text-sm">
                                Delete
                            </button>
                        </form>
                        <!-- End Delete Form -->
                    </div>
                </div>


                {{-- Applicants --}}
                <div class="mt-4 bg-gray-100 p-2">
                    <h4 class="text-lg font-semibold mb-2">Applicants</h4>
                    @forelse($job->applicants as $applicant)
                        <x-applicant-card :applicant="$applicant" />
                    @empty
                        <p class="text-gray-700">No applicants for this job</p>
                    @endforelse
                </div>

            @empty
                <p class="text-gray-700">You have not job listings</p>
            @endforelse
        </div>
    </section>
    <x-home-page-bottom-banner />
</x-layout>
