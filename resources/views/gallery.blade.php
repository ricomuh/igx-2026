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

        {{-- Gallery Grid Masonry-style --}}
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
                <div class="card-brutal bg-surface overflow-hidden group break-inside-avoid">
                    {{-- Colored offset frame --}}
                    <div class="relative">
                        <div class="absolute inset-0 {{ $color }} border-3 border-black {{ $rotation }} -z-10"></div>
                        <img src="{{ Storage::disk('public')->url($gallery->image) }}"
                             class="w-full h-auto object-cover border-3 border-black relative z-10 transform transition-transform duration-300 group-hover:scale-105"
                             alt="{{ $gallery->title }}"
                             loading="lazy">
                    </div>
                    @if($gallery->title || $gallery->description)
                    <div class="p-4">
                        @if($gallery->title)
                            <h3 class="text-base sm:text-lg font-extrabold uppercase text-black">{{ $gallery->title }}</h3>
                        @endif
                        @if($gallery->description)
                            <p class="text-xs font-bold text-black/50 mt-1 leading-relaxed">{{ $gallery->description }}</p>
                        @endif
                    </div>
                    @endif
                </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if($galleries->hasPages())
            <div class="mt-12 flex justify-center">
                {{ $galleries->links() }}
            </div>
            @endif
        @endif
    </div>
</div>
@endsection
