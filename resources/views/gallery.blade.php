@extends('layouts.main', ['title' => 'Gallery'])
@section('content')
<div class="bg-secondary border-b-4 border-black relative overflow-hidden">
    {{-- Halftone bg --}}
    <div class="absolute inset-0 z-0 pointer-events-none opacity-[0.06]"
         style="background-image: radial-gradient(circle, #fff 1px, transparent 1px); background-size: 18px 18px;">
    </div>

    <div class="container mx-auto px-5 xl:px-12 py-20 xl:py-28 relative z-10">
        {{-- Header --}}
        <div class="flex items-center gap-4 mb-12 lg:mb-16">
            <div class="bg-primary border-3 border-black px-5 py-3 shadow-brutal rotate-[-1deg]">
                <h1 class="text-xl sm:text-2xl lg:text-3xl font-extrabold uppercase text-black flex items-center gap-2">
                    <x-heroicon-o-camera class="w-6 h-6 sm:w-7 sm:h-7" />
                    GALLERY
                </h1>
            </div>
            <div class="h-0.5 flex-1 bg-white/10"></div>
            <span class="text-[10px] font-extrabold text-surface/30 uppercase tracking-[0.3em] hidden sm:block">{{ $galleries->count() }} PHOTOS</span>
        </div>

        {{-- Gallery Grid --}}
        @if($galleries->isEmpty())
            <div class="text-center py-20">
                <x-heroicon-o-photo class="w-16 h-16 text-surface/20 mx-auto mb-4" />
                <p class="text-lg font-extrabold uppercase text-surface/40">No photos uploaded yet.</p>
                <p class="text-sm font-bold text-surface/20 mt-2">Check back soon!</p>
            </div>
        @else
            <div class="columns-1 sm:columns-2 lg:columns-3 gap-5 lg:gap-6 space-y-5 lg:space-y-6" id="gallery-grid">
                @foreach($galleries as $gallery)
                @php
                    $rotations = ['-rotate-1', 'rotate-1', '-rotate-2', 'rotate-2', '-rotate-0.5'];
                    $rotation = $rotations[$loop->index % count($rotations)];
                    $colors = ['bg-primary', 'bg-accent', 'bg-highlight', 'bg-cyan'];
                    $color = $colors[$loop->index % count($colors)];
                @endphp
                <div class="card-brutal bg-surface overflow-hidden group break-inside-avoid cursor-pointer gallery-item"
                     data-index="{{ $loop->index }}"
                     data-src="{{ Storage::disk('public')->url($gallery->image) }}"
                     data-title="{{ $gallery->title }}">
                    {{-- Colored offset frame --}}
                    <div class="relative">
                        <div class="absolute inset-0 {{ $color }} border-3 border-black {{ $rotation }} -z-10"></div>
                        <img src="{{ Storage::disk('public')->url($gallery->image) }}"
                             class="w-full h-auto object-cover border-3 border-black relative z-10 transform transition-transform duration-300 group-hover:scale-105"
                             alt="{{ $gallery->title }}"
                             loading="lazy">
                    </div>
                    @if($gallery->title)
                    <div class="p-4">
                        <h3 class="text-base sm:text-lg font-extrabold uppercase text-black">{{ $gallery->title }}</h3>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

{{-- Lightbox --}}
<div id="lightbox" class="fixed inset-0 z-[9999] bg-black/95 hidden flex-col" style="display: none;">
    {{-- Close button --}}
    <button id="lightbox-close" class="absolute top-4 right-4 z-10 w-12 h-12 bg-highlight border-3 border-black shadow-brutal-sm flex items-center justify-center hover:bg-accent transition-colors">
        <x-heroicon-o-x-mark class="w-6 h-6 text-black" />
    </button>

    {{-- Counter --}}
    <div id="lightbox-counter" class="absolute top-4 left-4 z-10 bg-black border-2 border-highlight px-3 py-1.5 text-xs font-extrabold text-highlight uppercase tracking-wider"></div>

    {{-- Image container --}}
    <div class="flex-1 flex items-center justify-center px-16 py-20" id="lightbox-img-container">
        <img id="lightbox-img" src="" class="max-w-full max-h-full object-contain" alt="">
    </div>

    {{-- Title --}}
    <div id="lightbox-title" class="absolute bottom-20 left-1/2 -translate-x-1/2 bg-black border-2 border-highlight px-4 py-2 text-sm font-extrabold text-highlight uppercase"></div>

    {{-- Prev button --}}
    <button id="lightbox-prev" class="absolute left-4 top-1/2 -translate-y-1/2 w-14 h-14 bg-surface border-3 border-black shadow-brutal-sm flex items-center justify-center hover:bg-highlight transition-colors">
        <x-heroicon-o-chevron-left class="w-7 h-7 text-black" />
    </button>

    {{-- Next button --}}
    <button id="lightbox-next" class="absolute right-4 top-1/2 -translate-y-1/2 w-14 h-14 bg-surface border-3 border-black shadow-brutal-sm flex items-center justify-center hover:bg-highlight transition-colors">
        <x-heroicon-o-chevron-right class="w-7 h-7 text-black" />
    </button>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const items = document.querySelectorAll('.gallery-item');
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightbox-img');
    const lightboxTitle = document.getElementById('lightbox-title');
    const lightboxCounter = document.getElementById('lightbox-counter');
    const closeBtn = document.getElementById('lightbox-close');
    const prevBtn = document.getElementById('lightbox-prev');
    const nextBtn = document.getElementById('lightbox-next');
    let currentIndex = 0;
    const total = items.length;

    function open(index) {
        currentIndex = index;
        updateLightbox();
        lightbox.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function close() {
        lightbox.style.display = 'none';
        document.body.style.overflow = '';
    }

    function prev() {
        currentIndex = (currentIndex - 1 + total) % total;
        updateLightbox();
    }

    function next() {
        currentIndex = (currentIndex + 1) % total;
        updateLightbox();
    }

    function updateLightbox() {
        const item = items[currentIndex];
        const src = item.dataset.src;
        const title = item.dataset.title;
        lightboxImg.src = src;
        lightboxImg.alt = title;
        lightboxTitle.textContent = title || '';
        lightboxCounter.textContent = (currentIndex + 1) + ' / ' + total;
    }

    // Click to open
    items.forEach(function(item) {
        item.addEventListener('click', function() {
            open(parseInt(this.dataset.index));
        });
    });

    // Close
    closeBtn.addEventListener('click', close);
    lightbox.addEventListener('click', function(e) {
        if (e.target === lightbox) close();
    });

    // Navigation
    prevBtn.addEventListener('click', prev);
    nextBtn.addEventListener('click', next);

    // Keyboard
    document.addEventListener('keydown', function(e) {
        if (lightbox.style.display === 'none') return;
        if (e.key === 'Escape') close();
        if (e.key === 'ArrowLeft') prev();
        if (e.key === 'ArrowRight') next();
    });

    // Touch swipe
    let touchStartX = 0;
    let touchEndX = 0;

    lightbox.addEventListener('touchstart', function(e) {
        touchStartX = e.changedTouches[0].screenX;
    }, {passive: true});

    lightbox.addEventListener('touchend', function(e) {
        touchEndX = e.changedTouches[0].screenX;
        const diff = touchStartX - touchEndX;
        if (Math.abs(diff) > 50) {
            if (diff > 0) next();
            else prev();
        }
    }, {passive: true});
});
</script>
@endpush
