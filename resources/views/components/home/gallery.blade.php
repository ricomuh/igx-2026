{{-- Gallery Section — Neo-Brutalism --}}
@php $featuredGalleries = \App\Models\Gallery::where('is_active', true)->orderBy('sort_order')->limit(5)->get(); @endphp

@if($featuredGalleries->isNotEmpty())
<div class="bg-surface border-t-4 border-b-4 border-black py-20 xl:py-28">
    <div class="container mx-auto px-5">
        <div class="flex justify-center mb-16 sm:mb-20 md:mb-24">
            <h1 class="bg-bg border-3 border-black shadow-brutal px-6 py-4 text-3xl sm:text-4xl lg:text-5xl font-extrabold text-surface uppercase text-center rotate-[-1deg]">
                IGX Stage 03:
                <span class="block text-highlight">Gallery</span>
            </h1>
        </div>

        {{-- Gallery Grid --}}
        <div class="flex justify-center gap-4 sm:gap-6 flex-wrap mb-12 sm:mb-16 md:mb-20">
            @foreach($featuredGalleries as $gallery)
            @php
                $rotations = ['-rotate-2', 'rotate-1', '-rotate-1', 'rotate-2', '-rotate-3'];
                $rotation = $rotations[$loop->index];
                $mt = $loop->index % 2 === 1 ? '-mt-4 sm:-mt-8 md:-mt-12' : '';
                $colors = ['bg-primary', 'bg-accent', 'bg-highlight', 'bg-cyan', 'bg-crimson'];
                $color = $colors[$loop->index];
            @endphp
            <div class="w-full sm:w-[45%] xl:w-[40%] h-48 sm:h-56 md:h-64 xl:h-72 group overflow-hidden {{ $mt }}">
                <div class="relative h-full">
                    <div class="absolute inset-0 {{ $color }} border-3 border-black {{ $rotation }} -z-10"></div>
                    <img src="{{ Storage::disk('public')->url($gallery->image) }}"
                         class="w-full h-full object-cover border-3 border-black relative z-10 transform transition-transform duration-300 group-hover:scale-110"
                         alt="{{ $gallery->title }}"
                         loading="lazy">
                </div>
            </div>
            @endforeach
        </div>

        <div class="flex justify-center">
            <a href="{{ route('gallery') }}" class="btn-brutal-pink text-lg xl:text-xl px-8 py-4 inline-flex gap-3 items-center">
                See Full Gallery
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
            </a>
        </div>
    </div>
</div>
@endif
