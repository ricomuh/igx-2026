@extends('layouts.main', [
    'title' => $post->title,
])

@section('content')
<section id="detail-article">
    <div class="container px-12 mx-auto mt-20 pb-32">
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
        <h1 class="text-center text-4xl font-extrabold my-5">{{ $post->title }}</h1>
        <div class="flex items-center gap-2 opacity-90 justify-center mb-5">
            <img src="{{ asset('media/images/icons/calendar.svg') }}" class="size-5" alt="Calendar">
            <p class="font-medium text-lg">{{ \Carbon\Carbon::parse($post->created_at)->format('d M Y') }}</p>
        </div>

        {{-- Article Body --}}
        <div id="article-body" class="prose max-w-none text-lg">
            {!! $post->body !!}
        </div>

        {{-- Share Section --}}
        <x-news.article-share :url="route('news.show', ['post' => $post->slug])" :title="$post->title" />

        {{-- Read More --}}
        <div class="mt-8">
            <h1 class="font-extrabold text-3xl mb-8">Read More</h1>
            <x-news.card-news :posts="$recommended_posts" />
        </div>
    </div>
</section>
@endsection
