@props([
'url' => '/',
'icon' => null,
'bgClass' => 'bg-black',
'hoverClass' => 'hover:bg-green-800',
'textClass' => 'text-white',
'isActive' => true,
])

<a href="{{$url}}"
   class="{{$bgClass}} {{$hoverClass}} {{$textClass}}
   px-4 py-2 rounded hover:shadow-md transition duration-300
   {{ request()->is('jobs/create') ? 'bg-green-800' : '' }}
   ">
    @if($icon)
        <i class="fa fa-{{$icon}}"></i>
    @endif
    {{$slot}}
</a>
