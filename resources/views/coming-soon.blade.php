@extends('layouts.main', ['title' => 'Coming Soon'])
@section('content')
<div class="bg-bg min-h-screen relative overflow-hidden flex items-center justify-center">

    {{-- Halftone bg --}}
    <div class="absolute inset-0 z-0 pointer-events-none opacity-[0.06]"
         style="background-image: radial-gradient(circle, #000 1px, transparent 1px); background-size: 18px 18px;">
    </div>

    {{-- Accent blocks --}}
    <div class="absolute top-10 left-10 w-40 h-40 bg-highlight border-3 border-black rotate-12 opacity-30 z-0"></div>
    <div class="absolute bottom-10 right-10 w-56 h-56 bg-accent border-3 border-black -rotate-6 opacity-30 z-0"></div>
    <div class="absolute top-1/3 right-1/4 w-24 h-24 bg-crimson border-3 border-black rotate-45 opacity-20 z-0"></div>

    <div class="container mx-auto px-5 relative z-10 text-center">

        {{-- Neo-brutalism card --}}
        <div class="inline-block bg-surface border-4 border-black shadow-brutal-lg max-w-2xl w-full">

            {{-- Header --}}
            <div class="bg-black border-b-4 border-highlight px-6 py-5">
                <div class="flex items-center justify-center gap-3 mb-1">
                    <x-heroicon-o-clock class="w-6 h-6 text-highlight" />
                    <span class="text-xs font-extrabold uppercase text-highlight tracking-[0.3em]">MISSION PENDING</span>
                </div>
            </div>

            {{-- Body --}}
            <div class="px-6 py-12 sm:py-16">

                {{-- Big text --}}
                <div class="mb-8">
                    <div class="bg-highlight border-3 border-black shadow-brutal-sm inline-block px-6 py-3 rotate-[-1deg] mb-4">
                        <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold uppercase text-black leading-none">
                            COMING<br>SOON
                        </h1>
                    </div>
                </div>

                {{-- Year badge --}}
                <div class="mb-6">
                    <div class="bg-black border-3 border-accent inline-block px-8 py-3 shadow-brutal-sm">
                        <span class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-accent tracking-wider">2026</span>
                    </div>
                </div>

                {{-- Description --}}
                <p class="text-sm sm:text-base font-bold text-black/60 uppercase max-w-md mx-auto leading-relaxed mb-8">
                    We're cooking something epic.<br>
                    Stay tuned for updates.
                </p>

                {{-- Pulsing dots --}}
                <div class="flex items-center justify-center gap-2">
                    <div class="w-3 h-3 bg-highlight border-2 border-black animate-pulse"></div>
                    <div class="w-3 h-3 bg-accent border-2 border-black animate-pulse" style="animation-delay: 0.2s"></div>
                    <div class="w-3 h-3 bg-primary border-2 border-black animate-pulse" style="animation-delay: 0.4s"></div>
                </div>

            </div>

            {{-- Footer --}}
            <div class="border-t-4 border-black px-6 py-3 bg-black/5">
                <a href="{{ route('home') }}" class="text-xs font-extrabold uppercase text-black/40 hover:text-highlight transition-colors flex items-center justify-center gap-1 group">
                    <svg class="w-3 h-3 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 17l-5-5m0 0l5-5m-5 5h12"/>
                    </svg>
                    BACK TO HQ
                </a>
            </div>

        </div>

    </div>
</div>
@endsection
