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
    <x-news.card-news :posts="$latest_posts" />

    {{-- Pagination --}}
    <x-news.pagination :paginator="$latest_posts" />
</section>