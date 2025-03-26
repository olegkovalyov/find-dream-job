<x-layout>
    <h2 class="text-3xl text-center mb-4 font-bold border border-gray-300 p-3">
        Bookmarked Jobs
    </h2>
    @if(!count($bookmarks))
        <div class="text-gray-500 text-3xl text-center block">You have no bookmarked jobs</div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-3">
        @forelse($bookmarks as $bookmark)
            <x-job-card :job="$bookmark"/>
        @empty

        @endforelse
    </div>
    {{ $bookmarks->links() }}
</x-layout>
