@extends('layouts.main', ['title' => 'News'])

@section('content')
<div class="bg-bg border-b-4 border-black relative overflow-hidden min-h-screen">
    {{-- Halftone bg --}}
    <div class="absolute inset-0 z-0 pointer-events-none opacity-[0.06]"
         style="background-image: radial-gradient(circle, #fff 1px, transparent 1px); background-size: 18px 18px;">
    </div>

    <div class="container mx-auto px-5 xl:px-12 pt-28 pb-20 relative z-10">
        {{-- Header --}}
        <div class="flex flex-col lg:flex-row lg:justify-between gap-5 lg:gap-8 lg:items-end mb-8 lg:mb-12">
            <div>
                <div class="bg-accent border-3 border-black shadow-brutal px-6 py-3 inline-block rotate-[-1deg] mb-3">
                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold uppercase text-black flex items-center gap-2">
                        <x-heroicon-o-newspaper class="w-6 h-6 sm:w-8 sm:h-8" />
                        NEWS
                    </h1>
                </div>
                <p class="text-sm font-bold text-surface/60 uppercase ml-1">Latest updates & announcements</p>
            </div>

            <form method="GET" action="{{ route('news.index') }}" class="flex gap-2 w-full lg:w-auto">
                <div class="flex items-center gap-2 bg-black border-3 border-black px-4 py-2 flex-1 lg:min-w-[250px]">
                    <x-heroicon-o-magnifying-glass class="w-4 h-4 text-highlight shrink-0" />
                    <input type="search" name="search" placeholder="Search articles..." value="{{ request('search') }}"
                           class="bg-transparent outline-none text-sm font-bold text-surface placeholder:text-surface/30 w-full" />
                </div>
                <button type="submit" class="btn-brutal-yellow px-5 py-2 text-sm whitespace-nowrap">SEARCH</button>
            </form>
        </div>

        {{-- Popular News (featured top 2) --}}
        @if($popular_posts->isNotEmpty())
        <div class="mb-12 lg:mb-16">
            <div class="bg-black border-3 border-highlight px-4 py-2 inline-block shadow-brutal-sm rotate-[-0.5deg] mb-6">
                <h2 class="text-lg sm:text-xl font-extrabold uppercase text-highlight flex items-center gap-2">
                    <x-heroicon-o-fire class="w-5 h-5" /> POPULAR
                </h2>
            </div>

            <div class="grid md:grid-cols-2 gap-5 lg:gap-6">
                @foreach($popular_posts->take(2) as $post)
                <a href="{{ route('news.show', ['post' => $post->slug]) }}" class="card-brutal bg-surface group block overflow-hidden hover:shadow-brutal-lg hover:-translate-y-1 transition-all duration-200 no-underline">
                    <div class="aspect-video overflow-hidden border-b-3 border-black">
                        @php $img = $post->image_url; @endphp
                        <img src="{{ filter_var($img, FILTER_VALIDATE_URL) ? $img : asset('storage/' . $img) }}"
                             alt="{{ $post->title }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                             loading="lazy"
                             onerror="this.onerror=null;this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 400 225%22><rect fill=%22%23322366%22 width=%22400%22 height=%22225%22/><text x=%22200%22 y=%22120%22 text-anchor=%22middle%22 fill=%22%239A94CC%22 font-family=%22sans-serif%22 font-size=%2214%22 font-weight=%22bold%22>NO IMAGE</text></svg>';">
                    </div>
                    <div class="p-5">
                        <h3 class="text-lg sm:text-xl font-extrabold uppercase text-black mb-2 line-clamp-2">{{ $post->title }}</h3>
                        <div class="flex items-center gap-2 text-xs font-bold text-black/40 uppercase">
                            <x-heroicon-o-calendar-days class="w-3.5 h-3.5" />
                            {{ \Carbon\Carbon::parse($post->created_at)->format('d M Y') }}
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Latest News --}}
        <div>
            <div class="bg-black border-3 border-primary px-4 py-2 inline-block shadow-brutal-sm rotate-[-0.5deg] mb-6">
                <h2 class="text-lg sm:text-xl font-extrabold uppercase text-primary flex items-center gap-2">
                    <x-heroicon-o-clock class="w-5 h-5" /> LATEST
                </h2>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5 lg:gap-6">
                @forelse($latest_posts as $post)
                <a href="{{ route('news.show', ['post' => $post->slug]) }}" class="card-brutal bg-surface group block overflow-hidden hover:shadow-brutal-lg hover:-translate-y-1 transition-all duration-200 no-underline">
                    <div class="aspect-video overflow-hidden border-b-3 border-black">
                        @php $img = $post->image_url; @endphp
                        <img src="{{ filter_var($img, FILTER_VALIDATE_URL) ? $img : asset('storage/' . $img) }}"
                             alt="{{ $post->title }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                             loading="lazy"
                             onerror="this.onerror=null;this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 400 225%22><rect fill=%22%23322366%22 width=%22400%22 height=%22225%22/><text x=%22200%22 y=%22120%22 text-anchor=%22middle%22 fill=%22%239A94CC%22 font-family=%22sans-serif%22 font-size=%2214%22 font-weight=%22bold%22>NO IMAGE</text></svg>';">
                    </div>
                    <div class="p-4">
                        <h3 class="text-base sm:text-lg font-extrabold uppercase text-black mb-1.5 line-clamp-2">{{ $post->title }}</h3>
                        <p class="text-xs font-bold text-black/40 uppercase line-clamp-2 mb-2">{{ strip_tags($post->body) }}</p>
                        <div class="flex items-center gap-2 text-[10px] font-bold text-black/30 uppercase">
                            <x-heroicon-o-calendar-days class="w-3 h-3" />
                            {{ \Carbon\Carbon::parse($post->created_at)->format('d M Y') }}
                        </div>
                    </div>
                </a>
                @empty
                    <div class="col-span-full card-brutal bg-surface p-12 text-center">
                        <x-heroicon-o-newspaper class="w-12 h-12 text-black/20 mx-auto mb-3" />
                        <p class="text-lg font-extrabold uppercase text-black/40">No articles found.</p>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if($latest_posts->hasPages())
            <div class="mt-10 flex justify-center">
                {{ $latest_posts->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
