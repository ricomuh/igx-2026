@extends('layouts.main', ['title' => $post->title])

@push('style')
<style>
    #article-body h1 { font-size: 1.75rem; font-weight: 800; margin-bottom: 0.75rem; text-transform: uppercase; }
    #article-body h2 { font-size: 1.5rem; font-weight: 800; margin-bottom: 0.75rem; text-transform: uppercase; }
    #article-body h3 { font-size: 1.25rem; font-weight: 700; margin-bottom: 0.5rem; }
    #article-body p { margin-bottom: 1rem; line-height: 1.7; }
    #article-body ul, #article-body ol { margin-bottom: 1rem; padding-left: 1.5rem; }
    #article-body ul { list-style-type: disc; }
    #article-body ol { list-style-type: decimal; }
    #article-body li { margin-bottom: 0.5rem; }
    #article-body blockquote { margin: 1.5rem 0; padding: 1rem 1.5rem; border-left: 4px solid #F88832; background: #FAFAFA; font-weight: 600; }
    #article-body img { max-width: 100%; height: auto; margin: 1rem 0; border: 3px solid black; }
    #article-body table { width: 100%; border-collapse: collapse; margin: 1.5rem 0; border: 3px solid black; }
    #article-body table th, #article-body table td { border: 2px solid black; padding: 0.5rem 0.75rem; text-align: left; }
    #article-body table th { background: #322366; color: #FAFAFA; font-weight: 800; text-transform: uppercase; font-size: 0.85rem; }
    #article-body a { color: #F88832; font-weight: 700; text-decoration: underline; text-decoration-thickness: 2px; }
    #article-body a:hover { color: #F253B6; }

    @media (max-width: 640px) {
        #article-body h1 { font-size: 1.4rem; }
        #article-body h2 { font-size: 1.2rem; }
        #article-body p { font-size: 0.95rem; }
    }
</style>
@endpush

@section('content')
<div class="bg-surface min-h-screen">
    {{-- Hero image --}}
    <div class="relative w-full h-48 sm:h-64 md:h-80 lg:h-96 overflow-hidden border-b-4 border-black">
        @php $img = $post->image_url; @endphp
        <img src="{{ filter_var($img, FILTER_VALIDATE_URL) ? $img : asset('storage/' . $img) }}"
             alt="{{ $post->title }}"
             class="absolute inset-0 w-full h-full object-cover blur-sm scale-110 opacity-40"
             onerror="this.onerror=null;this.style.display='none';">
        <img src="{{ filter_var($img, FILTER_VALIDATE_URL) ? $img : asset('storage/' . $img) }}"
             alt="{{ $post->title }}"
             class="absolute inset-0 w-full h-full object-contain"
             onerror="this.onerror=null;this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 800 400%22><rect fill=%22%23322366%22 width=%22800%22 height=%22400%22/><text x=%22400%22 y=%22210%22 text-anchor=%22middle%22 fill=%22%239A94CC%22 font-family=%22sans-serif%22 font-size=%2220%22 font-weight=%22bold%22>NO IMAGE</text></svg>';">
    </div>

    <div class="container mx-auto px-5 xl:px-12 py-10 lg:py-16 max-w-3xl">
        {{-- Back link --}}
        <a href="{{ route('news.index') }}" class="inline-flex items-center gap-1.5 text-xs font-extrabold uppercase text-black/40 hover:text-primary transition-colors mb-6">
            <x-heroicon-o-arrow-left class="w-4 h-4" /> Back to News
        </a>

        {{-- Title --}}
        <div class="bg-accent border-3 border-black shadow-brutal-sm px-5 py-3 inline-block rotate-[-1deg] mb-6">
            <h1 class="text-xl sm:text-2xl lg:text-3xl font-extrabold uppercase text-black">{{ $post->title }}</h1>
        </div>

        {{-- Meta --}}
        <div class="flex flex-wrap items-center gap-4 mb-8">
            <div class="flex items-center gap-2 text-sm font-bold text-black/50 uppercase">
                <x-heroicon-o-calendar-days class="w-4 h-4" />
                {{ \Carbon\Carbon::parse($post->created_at)->format('d M Y') }}
            </div>
            @if($post->user)
            <div class="flex items-center gap-2 text-sm font-bold text-black/50 uppercase">
                <x-heroicon-o-user class="w-4 h-4" />
                {{ $post->user->name }}
            </div>
            @endif
        </div>

        {{-- Article body --}}
        <div id="article-body" class="prose max-w-none text-base lg:text-lg text-black font-medium leading-relaxed mb-12">
            {!! $post->body !!}
        </div>

        {{-- Share --}}
        <div class="border-t-3 border-black pt-8 mb-12">
            <p class="text-sm font-extrabold uppercase text-black/40 mb-4">Share this article</p>
            <div class="flex gap-2">
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('news.show', ['post' => $post->slug])) }}&text={{ urlencode($post->title) }}"
                   target="_blank" rel="noopener"
                   class="btn-brutal bg-black text-surface text-xs px-4 py-2.5">𝕏 Tweet</a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('news.show', ['post' => $post->slug])) }}"
                   target="_blank" rel="noopener"
                   class="btn-brutal bg-primary text-xs px-4 py-2.5">Facebook</a>
                <button onclick="navigator.clipboard.writeText('{{ route('news.show', ['post' => $post->slug]) }}')"
                        class="btn-brutal bg-highlight text-xs px-4 py-2.5">Copy Link</button>
            </div>
        </div>

        {{-- Read More --}}
        @if($recommended_posts->isNotEmpty())
        <div class="border-t-3 border-black pt-8">
            <div class="bg-black border-3 border-cyan px-4 py-2 inline-block shadow-brutal-sm rotate-[-0.5deg] mb-6">
                <h2 class="text-lg font-extrabold uppercase text-cyan flex items-center gap-2">
                    <x-heroicon-o-book-open class="w-5 h-5" /> READ MORE
                </h2>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-5">
                @foreach($recommended_posts->take(3) as $rec)
                <a href="{{ route('news.show', ['post' => $rec->slug]) }}" class="card-brutal bg-surface group block overflow-hidden hover:shadow-brutal-lg transition-all">
                    <div class="aspect-video bg-secondary overflow-hidden border-b-3 border-black">
                        @php $rimg = $rec->image_url; @endphp
                        <img src="{{ filter_var($rimg, FILTER_VALIDATE_URL) ? $rimg : asset('storage/' . $rimg) }}"
                             alt="{{ $rec->title }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform"
                             loading="lazy"
                             onerror="this.onerror=null;this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 400 225%22><rect fill=%22%23322366%22 width=%22400%22 height=%22225%22/><text x=%22200%22 y=%22120%22 text-anchor=%22middle%22 fill=%22%239A94CC%22 font-family=%22sans-serif%22 font-size=%2214%22 font-weight=%22bold%22>NO IMAGE</text></svg>';">
                    </div>
                    <div class="p-3">
                        <h3 class="text-sm font-extrabold uppercase text-black line-clamp-2">{{ $rec->title }}</h3>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
