<a
    href="{{$href}}"
    class="
               text-white hover:bg-green-800 px-4 py-2 rounded hover:shadow-md transition duration-300
               {{ request()->is($currentUrl) ? 'bg-green-800 hover:text-white px-4 py-2 rounded hover:shadow-md transition duration-300' :  ''}}"

>
    @if($icon)
        <i class="{{ $icon }}"></i>
    @endif
    {{ $title }}
</a>
