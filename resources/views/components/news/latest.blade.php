<section>
    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:justify-between gap-4 md:items-center mb-8 md:mb-10 xl:mb-12">
        <h1 class="text-3xl md:text-4xl xl:text-5xl font-extrabold">Latest News</h1>

        <form method="GET" action="{{ route('news.index') }}" class="flex w-full md:w-auto gap-2">
            {{-- Input Wrapper --}}
            <div class="flex items-center gap-2 bg-white rounded-lg px-4 py-2 text-black transition duration-200 ring ring-primary flex-1 min-w-0">
                <img src="{{ asset('media/images/icons/search.svg') }}" width="16" alt="">
                <input
                    type="search"
                    name="search"
                    id="search"
                    placeholder="Search"
                    value="{{ request('search') }}"
                    class="outline-none w-full"
                />
            </div>

            {{-- Button --}}
            <button type="submit"
                    class="btn-primary whitespace-nowrap text-center py-2 px-4 font-bold rounded-lg">
                Search
            </button>
        </form>
    </div>

    {{-- List News --}}
    <x-news.card-news :posts="$latest_posts" />

    {{-- Pagination --}}
    <x-news.pagination :paginator="$latest_posts" />
</section>
