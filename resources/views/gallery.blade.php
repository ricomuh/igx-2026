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
            <div class="columns-1 sm:columns-2 lg:columns-3 gap-5 lg:gap-6 space-y-5 lg:space-y-6">
                @foreach($galleries as $gallery)
                @php
                    $rotations = ['-rotate-1', 'rotate-1', '-rotate-2', 'rotate-2', '-rotate-0.5'];
                    $rotation = $rotations[$loop->index % count($rotations)];
                    $colors = ['bg-primary', 'bg-accent', 'bg-highlight', 'bg-cyan'];
                    $color = $colors[$loop->index % count($colors)];
                @endphp
                <button onclick="showImage({{ $loop->index }})"
                        class="card-brutal bg-surface overflow-hidden group break-inside-avoid cursor-pointer text-left w-full">
                    {{-- Colored offset frame --}}
                    <div class="relative">
                        <div class="absolute inset-0 {{ $color }} border-3 border-black {{ $rotation }} -z-10"></div>
                        <img src="{{ Storage::disk('public')->url($gallery->image) }}"
                             class="w-full h-auto object-cover border-3 border-black relative z-10 transform transition-transform duration-300 group-hover:scale-105"
                             alt="{{ $gallery->title }}"
                             loading="lazy">
                        {{-- Hover overlay --}}
                        <div class="absolute inset-0 bg-black/60 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-20">
                            <div class="bg-highlight border-3 border-black px-5 py-3 shadow-brutal rotate-[-1deg]">
                                <span class="text-sm font-extrabold uppercase text-black flex items-center gap-2">
                                    <x-heroicon-o-magnifying-glass-plus class="w-5 h-5" />
                                    VIEW
                                </span>
                            </div>
                        </div>
                    </div>
                    @if($gallery->title)
                    <div class="p-4">
                        <h3 class="text-base sm:text-lg font-extrabold uppercase text-black">{{ $gallery->title }}</h3>
                    </div>
                    @endif
                </button>
                @endforeach
            </div>
        @endif
    </div>
</div>

{{-- Lightbox Modal (rundown style with prev/next navigation) --}}
<div id="imageModal" class="fixed inset-0 bg-black/95 hidden items-center justify-center p-4" onclick="hideImage()" style="z-index: 99999;">
    <div class="relative inline-block max-w-full max-h-full">
        {{-- Previous Button --}}
        <button onclick="event.stopPropagation(); prevImage()"
                class="absolute left-4 top-1/2 -translate-y-1/2 bg-highlight border-3 border-black shadow-brutal-sm w-12 h-12 flex items-center justify-center hover:bg-accent transition-colors cursor-pointer z-30">
            <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" stroke-width="4" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>

        {{-- Next Button --}}
        <button onclick="event.stopPropagation(); nextImage()"
                class="absolute right-4 top-1/2 -translate-y-1/2 bg-highlight border-3 border-black shadow-brutal-sm w-12 h-12 flex items-center justify-center hover:bg-accent transition-colors cursor-pointer z-30">
            <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" stroke-width="4" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
        </button>

        <img id="modalImage" src="" alt="" class="max-w-[95vw] max-h-[95vh] object-contain border-3 border-highlight shadow-brutal-lg" onclick="event.stopPropagation()">
        
        <button onclick="hideImage()"
                class="absolute -top-4 -right-4 bg-crimson border-3 border-black shadow-brutal-sm w-10 h-10 flex items-center justify-center hover:bg-accent transition-colors cursor-pointer z-30">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="4" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
</div>
@endsection

@push('scripts')
<script>
const images = [
    @foreach($galleries as $gallery)
    '{{ Storage::disk('public')->url($gallery->image) }}',
    @endforeach
];
let currentIdx = 0;

const showImage = (idx) => {
    currentIdx = idx;
    document.getElementById('modalImage').src = images[currentIdx];
    document.getElementById('imageModal').classList.remove('hidden');
    document.getElementById('imageModal').classList.add('flex');
    document.body.style.overflow = 'hidden';
}
const hideImage = () => {
    document.getElementById('imageModal').classList.add('hidden');
    document.getElementById('imageModal').classList.remove('flex');
    document.body.style.overflow = 'auto';
}
const prevImage = () => {
    currentIdx = (currentIdx - 1 + images.length) % images.length;
    document.getElementById('modalImage').src = images[currentIdx];
}
const nextImage = () => {
    currentIdx = (currentIdx + 1) % images.length;
    document.getElementById('modalImage').src = images[currentIdx];
}
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') hideImage();
    if (e.key === 'ArrowLeft') prevImage();
    if (e.key === 'ArrowRight') nextImage();
});
</script>
@endpush
