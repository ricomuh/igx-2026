@extends('layouts.main', [
    'title' => $post->title,
])

@push('style')
<style>
    #article-body h1 {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.75rem;
        line-height: 1.25;
    }

    #article-body h2 {
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 0.75rem;
        line-height: 1.3;
    }

    #article-body h3 {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    #article-body h4 {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    #article-body h5 {
        font-size: 1.125rem;
        font-weight: 500;
        margin-bottom: 0.375rem;
    }

    #article-body h6 {
        font-size: 1rem;
        font-weight: 500;
        margin-bottom: 0.375rem;
    }

    #article-body p {
        margin-bottom: 1rem;
        line-height: 1.625;
    }

    #article-body ul {
        margin-bottom: 1rem;
        padding-left: 1.25rem;
        list-style-type: disc;
    }

    #article-body ul li {
        margin-bottom: 0.5rem;
    }

    #article-body ol {
        margin-bottom: 1rem;
        padding-left: 1.25rem;
        list-style-type: decimal;
    }

    #article-body ol li {
        margin-bottom: 0.5rem;
    }

    #article-body blockquote {
        margin: 1.5rem 0;
        padding: 1rem;
        border-left: 4px solid #d1d5db;
        background-color: #f3f4f6;
        color: #374151;
        border-radius: 0.375rem;
    }

    #article-body img {
        max-width: 100%;
        height: auto;
        margin: 1rem 0;
        border-radius: 0.5rem;
    }

    #article-body table {
        width: 100%;
        border-collapse: collapse;
        margin: 1.5rem 0;
        text-align: left;
        font-size: 0.875rem;
    }

    #article-body table th,
    #article-body table td {
        border: 1px solid #d1d5db;
        padding: 0.5rem;
    }

    @media (max-width: 768px) {
        #article-body table {
            display: block;
            overflow-x: auto;
            white-space: nowrap;
        }

        #article-body h1 {
            font-size: 1.5rem;
        }

        #article-body h2 {
            font-size: 1.25rem;
        }

        #article-body h3 {
            font-size: 1.125rem;
        }

        #article-body h4 {
            font-size: 1rem;
        }

        #article-body p {
            margin-bottom: 0.75rem;
        }
    }
</style>
@endpush

@section('content')
<section id="detail-article">
    <div class="container px-5 xl:px-12 mx-auto mt-24">
        {{-- Article Image --}}
        <div class="relative mb-6 overflow-hidden rounded-lg md:mb-8 md:max-h-96 lg:mb-10 lg:max-h-[30rem] xl:mb-12">
            <img
                src="{{ $post->image_url }}"
                alt="{{ $post->title }}"
                class="mb-6 aspect-video h-full w-full scale-110 rounded-lg object-cover opacity-50 blur"
            />
            <img
                src="{{ $post->image_url }}"
                alt="{{ $post->title }}"
                class="absolute left-0 top-0 h-full w-full object-contain"
            />
        </div>

        {{-- Article Title --}}
        <h1 class="text-center text-2xl sm:text-3xl lg:text-4xl xl:text-5xl font-extrabold my-5">{{ $post->title }}</h1>
        <div class="flex items-center gap-2 opacity-90 justify-center mb-5">
            <img src="{{ asset('media/images/icons/calendar.svg') }}" class="size-5" alt="Calendar">
            <p class="font-medium text-sm sm:text-base md:text-lg">{{ \Carbon\Carbon::parse($post->created_at)->format('d M Y') }}</p>
        </div>

        {{-- Article Body --}}
        <div id="article-body" class="prose max-w-none text-sm sm:text-base md:text-lg">
            {!! $post->body !!}
        </div>

        {{-- Share Section --}}
        <x-news.article-share :url="route('news.show', ['post' => $post->slug])" :title="$post->title" />

        {{-- Read More --}}
        <div class="mt-8">
            <h1 class="font-extrabold text-2xl sm:text-3xl lg:text-4xl mb-8">Read More</h1>
            <x-news.card-news :posts="$recommended_posts" />
        </div>
    </div>
</section>
@endsection
