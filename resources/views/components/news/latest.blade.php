<section>
    {{-- Header --}}
    <div class="flex justify-between items-center mb-12">
        <h1 class="text-5xl font-extrabold">Latest News</h1>
        <form method="GET" action="{{ route('news.index') }}" class="flex gap-2 items-center h-full group">
            <div class="flex gap-2 items-center bg-white rounded-lg px-4 py-2 text-black transition duration-200 ring ring-primary">
                <img src="{{ asset('media/images/icons/search.svg') }}" width="16" alt="">
                <input
                    type="search"
                    name="search"
                    id="search"
                    placeholder="Search"
                    value="{{ request('search') }}"
                    class="outline-none"
                />
            </div>
            <button type="submit" class="btn-primary text-center py-2 px-4 font-bold rounded-lg">Search</button>
        </form>
    </div>
    
    {{-- List News --}}
    <div class="grid grid-cols-2 gap-8">
        @forelse ($latest_posts as $news)
            <a href="{{ route('news.show', ['post' => $news->slug]) }}" class="block">
                <div class="flex items-center hover:bg-white/20 rounded-2xl overflow-hidden group hover:shadow-lg transition duration-300">
                    <img src="{{ $news->image_url }}" alt="{{ $news->title }}" class="aspect-video h-40 object-cover rounded-2xl m-4 group-hover:scale-105 transition duration-300" />
                    <div class="p-4">
                        <h2 class="text-2xl font-extrabold mb-2 transition group-hover:text-background-footer duration-300">{{ Str::limit($news->title, 35, '...') }}</h2>
                        <p class="group-hover:text-background-footer mb-2 opacity-90 text-lg transition duration-300">{{ Str::limit($news->body, 75, '...') }}</p>
                        <div class="flex gap-2 items-center opacity-90">
                            <img src="{{ asset('media/images/icons/calendar.svg') }}" class="w-4" alt="">
                            <p class="font-medium">{{ \Carbon\Carbon::parse($news->created_at)->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>
            </a>
        @empty
            <p class="text-center col-span-2 text-lg font-medium text-gray-500">No news found.</p>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="flex justify-center mt-12 space-x-2 mb-24">
        @if ($latest_posts->onFirstPage())
            <button class="px-4 py-1 border border-gray-300 rounded text-gray-400 cursor-not-allowed">&laquo;</button>
        @else
            <a href="{{ $latest_posts->previousPageUrl() }}" class="px-4 py-1 border border-primary rounded hover:bg-gray-200 text-primary cursor-pointer text-lg">&laquo;</a>
        @endif

        @foreach ($latest_posts->getUrlRange(1, $latest_posts->lastPage()) as $page => $url)
            @if ($page == $latest_posts->currentPage())
                <button class="px-4 py-1 border border-primary rounded bg-primary text-white font-bold">{{ $page }}</button>
            @else
                <a href="{{ $url }}" class="px-4 py-1 border border-primary rounded hover:bg-gray-200 text-primary cursor-pointer text-lg">{{ $page }}</a>
            @endif
        @endforeach

        @if ($latest_posts->hasMorePages())
            <a href="{{ $latest_posts->nextPageUrl() }}" class="px-4 py-1 border border-primary rounded hover:bg-gray-200 text-primary cursor-pointer text-lg">&raquo;</a>
        @else
            <button class="px-4 py-1 border border-gray-300 rounded text-gray-400 cursor-not-allowed">&raquo;</button>
        @endif
    </div>
</section>