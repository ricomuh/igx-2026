@php
    $newsList = [
        ['title' => 'Monster Hunter Wild', 'description' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Hic nihil, natus ...', 'image' => 'media/images/placeholder/news1.jpg'],
        ['title' => 'Monster Hunter Rise', 'description' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Hic nihil, natus ...', 'image' => 'media/images/placeholder/news1.jpg'],
        ['title' => 'Monster Hunter World', 'description' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Hic nihil, natus ...', 'image' => 'media/images/placeholder/news1.jpg'],
        ['title' => 'Monster Hunter Stories', 'description' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Hic nihil, natus ...', 'image' => 'media/images/placeholder/news1.jpg'],
        ['title' => 'Monster Hunter Generations', 'description' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Hic nihil, natus ...', 'image' => 'media/images/placeholder/news1.jpg'],
        ['title' => 'Monster Hunter Frontier', 'description' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Hic nihil, natus ...', 'image' => 'media/images/placeholder/news1.jpg'],
    ];
@endphp

<section>
    {{-- Header --}}
    <div class="flex justify-between items-center mb-12">
        <h1 class="text-5xl font-extrabold">Latest News</h1>
        <div class="flex gap-2 items-center h-full group">
            <div class="flex gap-2 items-center bg-white rounded-lg px-4 py-2 text-black transition duration-200 ring ring-primary">
                <img src="{{asset('media/images/icons/search.svg')}}" width="16" alt="">
                <input
                    type="search"
                    name="search"
                    id="search"
                    placeholder="Search"
                    class="outline-none"
                />
            </div>
            <button class="btn-primary text-center py-2 px-4 font-bold rounded-lg">Search</button>
        </div>
    </div>
    
    {{-- List News --}}
    <div class="grid grid-cols-2 gap-8">
        @foreach ($newsList as $news)
            <div class="flex items-center hover:bg-white/20 rounded-2xl overflow-hidden group hover:shadow-lg transition duration-300">
                <img src="{{ asset($news['image']) }}" alt="{{ $news['title'] }}" class="aspect-video h-40 object-cover rounded-2xl m-4 group-hover:scale-105 transition duration-300" />
                <div class="p-4">
                    <h2 class="text-3xl font-extrabold mb-2 transition group-hover:text-background-footer duration-300">{{ $news['title'] }}</h2>
                    <p class="group-hover:text-background-footer mb-2 opacity-90 text-lg transition duration-300">{{ $news['description'] }}</p>
                    <div class="flex gap-2 items-center opacity-90">
                        <img src="{{asset('media/images/icons/calendar.svg')}}" class="w-4" alt="">
                        <p class="font-medium">12 Nov 2024</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="flex justify-center mt-12 space-x-2">
        <button class="px-4 py-1 border border-primary rounded hover:bg-gray-200 text-primary cursor-pointer text-lg">&laquo;</button>
        <button class="px-4 py-1 border border-primary rounded bg-primary text-white font-bold">1</button>
        <button class="px-4 py-1 border border-primary rounded hover:bg-gray-200 text-primary cursor-pointer text-lg">2</button>
        <button class="px-4 py-1 border border-primary rounded hover:bg-gray-200 text-primary cursor-pointer text-lg">3</button>
        <button class="px-4 py-1 border border-primary rounded hover:bg-gray-200 text-primary cursor-pointer text-lg">&raquo;</button>
    </div>
</section>