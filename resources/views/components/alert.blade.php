@props(['type', 'message'])

@if(session()->has($type))
    <div id="alertNotification" class="p-4 mb-4 text-lg text-white rounded-2xl font-bold text-center {{$type == 'success' ? 'bg-green-600' : 'bg-red-500'}}">
        <i class="fa {{$type == 'success' ? 'fa-check' : 'fa-ban'}} text-2xl"></i> {{$message}}
    </div>
@endif
