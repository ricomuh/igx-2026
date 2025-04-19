@extends('layouts.main', [
    'title' => $post->title,
])

@section('content')
<section id="detail-article">
    <div class="container px-12 mx-auto mt-20 pb-40">
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

        {{-- Article Body --}}
        <p class="text-lg">{{ $post->body }}</p>

        {{-- Share Section --}}
        <div class="mt-12 flex gap-5 items-center">
            <p class="text-lg">Share on:</p>

            {{-- Facebook Share --}}
            <a
                target="_blank"
                rel="noopener noreferrer"
                href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('news.show', ['post' => $post->slug])) }}&t={{ urlencode($post->title) }}"
                class="hover:text-primary"
                aria-label="Share on Facebook"
            >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-6 fill-current">
                    <path d="M512 256C512 114.6 397.4 0 256 0S0 114.6 0 256C0 376 82.7 476.8 194.2 504.5V334.2H141.4V256h52.8V222.3c0-87.1 39.4-127.5 125-127.5c16.2 0 44.2 3.2 55.7 6.4V172c-6-.6-16.5-1-29.6-1c-42 0-58.2 15.9-58.2 57.2V256h83.6l-14.4 78.2H287V510.1C413.8 494.8 512 386.9 512 256h0z" />
                </svg>
            </a>

            {{-- Instagram Share --}}
            <a
                target="_blank"
                rel="noopener noreferrer"
                href="https://www.instagram.com/?url={{ urlencode(route('news.show', ['post' => $post->slug])) }}&title={{ urlencode($post->title) }}"
                class="hover:text-primary"
                aria-label="Share on Instagram"
            >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-6 fill-current">
                    <path d="M224.1 141c-63.6 0-115.1 51.5-115.1 115.1s51.5 115.1 115.1 115.1 115.1-51.5 115.1-115.1-51.5-115.1-115.1-115.1zm0 190.2c-41.5 0-75.1-33.6-75.1-75.1s33.6-75.1 75.1-75.1 75.1 33.6 75.1 75.1-33.6 75.1-75.1 75.1zm146.4-194.3c0 14.9-12.1 27-27 27s-27-12.1-27-27 12.1-27 27-27 27 12.1 27 27zm76.1 27.2c-1.7-35.7-9.9-67.3-36.2-93.6s-57.9-34.5-93.6-36.2c-37-2.1-147.8-2.1-184.8 0-35.7 1.7-67.3 9.9-93.6 36.2s-34.5 57.9-36.2 93.6c-2.1 37-2.1 147.8 0 184.8 1.7 35.7 9.9 67.3 36.2 93.6s57.9 34.5 93.6 36.2c37 2.1 147.8 2.1 184.8 0 35.7-1.7 67.3-9.9 93.6-36.2s34.5-57.9 36.2-93.6c2.1-37 2.1-147.8 0-184.8zm-48.1 224.5c-7.8 19.6-22.9 34.7-42.5 42.5-29.4 11.7-99.2 9-132.9 9s-103.5 2.6-132.9-9c-19.6-7.8-34.7-22.9-42.5-42.5-11.7-29.4-9-99.2-9-132.9s-2.6-103.5 9-132.9c7.8-19.6 22.9-34.7 42.5-42.5 29.4-11.7 99.2-9 132.9-9s103.5-2.6 132.9 9c19.6 7.8 34.7 22.9 42.5 42.5 11.7 29.4 9 99.2 9 132.9s2.6 103.5-9 132.9z" />
                </svg>
            </a>

            {{-- WhatsApp Share --}}
            <a
                target="_blank"
                rel="noopener noreferrer"
                href="https://api.whatsapp.com/send?text={{ urlencode($post->title . ' ' . route('news.show', ['post' => $post->slug])) }}"
                class="hover:text-primary"
                aria-label="Share on WhatsApp"
            >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-6 fill-current">
                    <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" />
                </svg>
            </a>
        </div>
    </div>
</section>
@endsection