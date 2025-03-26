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
    {{-- Delete Applicant --}}
    <p class="text-gray-800 my-4">
        <a href="{{route('applicant.download', $applicant->id)}}" class="text-blue-500 hover:underline">
            <i class="fas fa-download"></i> Download Resume
        </a>
    </p>
    <p class="text-gray-800 my-4">
    <form method="POST" action="{{route('applicant.destroy', $applicant->id)}}"
          onsubmit="return confirm('Are you sure you want to delete this applicant?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="cursor-pointer text-red-500 hover:text-red-700">
            <i class="fas fa-trash"></i> Delete Applicant
        </button>
    </form>
    </p>
</div>
