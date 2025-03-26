@props(['job'])

<div x-data="{ open: {{$errors->any() ? 'true' : 'false'}} }" id="applicant-form">
    <button @click="open = true"
            class="block w-full text-center px-5 py-2.5 shadow-sm rounded border text-base font-medium cursor-pointer text-indigo-700 bg-indigo-100 hover:bg-indigo-200">
        Apply Now
    </button>

    <div x-show="open" class="modal fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 overflow-y-scroll ">
        <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md modal-container">
            <h3 class="text-lg font-semibold mb-4">
                Apply For {{$job->title}}
            </h3>
            <form method="POST" action="{{route('applicant.store', $job->id)}}" enctype="multipart/form-data">
                @csrf
                <x-form.text id="full_name" name="full_name" label="Full Name" :required="true"/>
                <x-form.text id="contact_phone" name="contact_phone" label="Contact Phone"/>
                <x-form.text id="contact_email" name="contact_email" label="Contact Email" :required="true"/>
                <x-form.text-area id="message" name="message" label="Message"/>
                <x-form.text id="location" name="location" label="Location"/>
                <x-form.file id="resume" name="resume" label="Upload Your Resume (pdf)" :required="true" />

                <button type="submit" class="cursor-pointer bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">Submit
                    Application</button>
                <button @click="open = false"
                        class="cursor-pointer bg-gray-300 hover:bg-gray-400 text-black px-4 py-2 rounded-md">Cancel</button>
            </form>
        </div>
    </div>
</div>
