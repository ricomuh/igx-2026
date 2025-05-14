@push('style')
    <style>
        .filter-gray {
            filter: invert(73%) sepia(11%) saturate(249%) hue-rotate(202deg) brightness(88%) contrast(90%);
        }

        @media (max-width: 639px) {
            .no-hover\:hover\:bg-none:hover {
                background-color: transparent !important;
            }
        }
    </style>
@endpush

<div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
    @forelse ($posts as $news)
        <a href="{{ route('news.show', ['post' => $news->slug]) }}" class="block">
            <div class="group flex flex-col sm:flex-row items-center rounded-2xl overflow-hidden transition duration-300
                        hover:bg-background-footer/10 no-hover:hover:bg-none">

                {{-- Thumbnail Wrapper --}}
                <div class="aspect-video sm:h-40 m-0 sm:m-4 overflow-hidden rounded-xl sm:rounded-2xl transition duration-300">
                    <img src="{{ $news->image_url }}"
                         alt="{{ $news->title }}"
                         class="w-full h-full object-cover transition duration-300 group-hover:scale-105" />
                </div>

                {{-- Content --}}
                <div class="py-2 md:p-4">
                    <h2 class="text-xl md:text-2xl font-extrabold mb-2 transition duration-300 group-hover:text-background-footer">
                        {{ Str::limit($news->title, 35, '...') }}
                    </h2>

                    <p class="mb-2 opacity-90 text-base md:text-lg text-gray-600 transition duration-300">
                        {!! Str::limit(strip_tags($news->body), 70, '...') !!}
                    </p>

                    <div class="flex gap-2 items-center opacity-90">
                        <img src="{{ asset('media/images/icons/calendar.svg') }}" class="w-4 filter-gray" alt="">
                        <p class="font-medium text-gray-600 text-sm sm:text-base">
                            {{ \Carbon\Carbon::parse($news->created_at)->format('d M Y') }}
                        </p>
                    </div>
                </div>
            </div>
        </a>
    @empty
        <p class="text-center col-span-1 sm:col-span-2 lg:col-span-3 text-lg font-medium text-gray-500">No news found.</p>
    @endforelse
</div>
