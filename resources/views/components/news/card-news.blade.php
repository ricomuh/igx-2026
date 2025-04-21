<div class="grid grid-cols-2 gap-6">
    @forelse ($posts as $news)
        <a href="{{ route('news.show', ['post' => $news->slug]) }}" class="block">
            <div class="flex items-center hover:bg-background-footer/10 rounded-2xl overflow-hidden group transition duration-300">
                <img src="{{ $news->image_url }}" alt="{{ $news->title }}" class="aspect-video h-40 object-cover rounded-2xl m-4 transition duration-300" />
                <div class="p-4">
                    <h2 class="text-2xl font-extrabold mb-2 transition group-hover:text-background-footer duration-300">{{ Str::limit($news->title, 35, '...') }}</h2>
                    <p class="mb-2 opacity-90 text-lg transition text-gray-600 duration-300">{!! Str::limit(strip_tags($news->body), 70, '...') !!}</p>
                    <div class="flex gap-2 items-center opacity-90">
                        <img src="{{ asset('media/images/icons/calendar.svg') }}" class="w-4 filter-gray" alt="">
                        <p class="font-medium text-gray-600">{{ \Carbon\Carbon::parse($news->created_at)->format('d M Y') }}</p>
                    </div>
                </div>
            </div>
        </a>
    @empty
        <p class="text-center col-span-2 text-lg font-medium text-gray-500">No news found.</p>
    @endforelse
</div>

@section('style')
    <style>
        .filter-gray {
            filter: invert(73%) sepia(11%) saturate(249%) hue-rotate(202deg) brightness(88%) contrast(90%);
        }
    </style>
@endsection