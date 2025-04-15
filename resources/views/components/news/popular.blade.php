<section id="popular" class="mb-12">
    <h1 class="text-5xl font-extrabold mb-12 tracking-tight">Popular News</h1>
    <div class="grid grid-cols-6 gap-5 w-full">
        @foreach ($popular_posts as $index => $post)
            @php
                $colSpan = in_array($index, [0, 1]) ? 'col-span-3' : 'col-span-2';
                $sizeTitle = in_array($index, [0, 1]) ? 'text-4xl' : 'text-3xl';
            @endphp

            <div class="{{ $colSpan }}">
                <a href="{{ route('news.show', ['post' => $post['slug']]) }}" class="block">
                    <div class="aspect-video rounded-3xl overflow-hidden group relative">
                        {{-- Image --}}
                        <img
                            src="{{ $post['image_url'] }}"
                            alt="{{ $post['title'] }}"
                            class="w-full h-full object-cover transition duration-300 group-hover:scale-110"
                        >

                        {{-- Darker Gradient Overlay --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/60 to-transparent opacity-100 transition duration-300 group-hover:opacity-80"></div>

                        {{-- Content --}}
                        <div class="absolute bottom-0 left-0 p-4 xl:p-6 text-white">
                            <h1 class="{{ $sizeTitle }} font-extrabold leading-snug">
                                {{ Str::limit($post['title'], 20, '...') }}
                            </h1>
                            <div class="flex items-center gap-2 opacity-90 mt-2">
                                <img src="{{ asset('media/images/icons/calendar.svg') }}" class="w-4 invert brightness-0" alt="Calendar">
                                <p class="font-medium text-white/90 text-sm md:text-base">{{ \Carbon\Carbon::parse($post['created_at'])->format('d M Y') }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</section>