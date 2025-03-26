@props(['applicant'])

<div class="py-2">
    <p class="text-gray-800">
        <strong>Name: </strong> {{$applicant->full_name}}
    </p>
    <p class="text-gray-800">
        <strong>Phone: </strong> {{$applicant->contact_phone}}
    </p>
    <p class="text-gray-800">
        <strong>Email: </strong> {{$applicant->contact_email}}
    </p>
    <p class="text-gray-800">
        <strong>Message: </strong> {{$applicant->message}}
    </p>
    <p class="text-gray-800 my-4">
        <a href="{{route('applicant.download', $applicant->id)}}" class="text-blue-500 hover:underline">
            <i class="fas fa-download"></i> Download Resume
        </a>
    </p>
</div>
