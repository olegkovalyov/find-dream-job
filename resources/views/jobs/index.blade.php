<x-layout>
    <x-slot name="title">Available jobs</x-slot>
    <h1>Available Jobs</h1>
    <ul>
        @forelse($jobs as $job)
            <li><a href="{{route('jobs.show', $job->id)}}">{{$job->title}}</a> - {{$job->description}}</li>
        @empty
            <li>No jobs available</li>
        @endforelse
    </ul>
</x-layout>
