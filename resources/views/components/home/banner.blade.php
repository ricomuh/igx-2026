{{-- Stage 03 Hero — Centered Key Art Layout --}}
<div class="bg-bg min-h-screen relative overflow-hidden flex flex-col">

    {{-- Halftone dots + scanlines --}}
    <div class="absolute inset-0 z-0 pointer-events-none"
         style="background:
            radial-gradient(circle, rgba(255,255,255,0.08) 1px, transparent 1px) 0 0 / 20px 20px,
            repeating-linear-gradient(0deg, transparent, transparent 2px, rgba(0,0,0,0.03) 2px, rgba(0,0,0,0.03) 4px);">
    </div>

    {{-- Subtle bg accents --}}
    <div class="absolute top-[15%] left-[5%] w-72 h-72 bg-accent border-3 border-black rotate-12 opacity-20 z-0"></div>
    <div class="absolute bottom-[20%] right-[5%] w-48 h-48 bg-highlight border-3 border-black -rotate-6 opacity-20 z-0"></div>

    {{-- Floating gallery images — neo brutalism --}}
    @php
        $sideImages = \App\Models\Gallery::where('is_active', true)->inRandomOrder()->limit(6)->get();
    @endphp
    @foreach($sideImages as $idx => $img)
        @php
            $side = $idx % 2 === 0 ? 'left' : 'right';
            $offsets = [
                ['top-[8%] left-[2%] -rotate-6', 'top-[8%] right-[2%] rotate-3'],
                ['top-[40%] left-[3%] rotate-3', 'top-[35%] right-[3%] -rotate-6'],
                ['bottom-[10%] left-[2%] rotate-6', 'bottom-[15%] right-[2%] -rotate-3'],
            ];
            $pos = $offsets[$idx % 3][$idx % 2];
        @endphp
        <div class="absolute {{ $pos }} z-0 w-24 sm:w-32 lg:w-36 border-3 border-black shadow-brutal-sm opacity-25 hover:opacity-60 transition-opacity duration-300 overflow-hidden">
            <img src="{{ Storage::disk('public')->url($img->image) }}"
                 class="w-full aspect-square object-cover"
                 alt="{{ $img->title }}"
                 loading="lazy">
        </div>
    @endforeach

    <div class="container mx-auto px-5 xl:px-12 relative z-10 flex-1 flex flex-col items-center justify-center text-center py-20 lg:py-0">

        {{-- ===== KEY ART — CENTERED ===== --}}
        <div class="relative">
            {{-- Layer 1: Background --}}
            <div class="relative z-20 floating-bg drop-shadow-[6px_6px_0px_#000]">
                <img src="{{ asset('media/images/illustrations/hero-bg.webp') }}"
                     class="w-full max-w-[280px] sm:max-w-[360px] lg:max-w-[460px] xl:max-w-[540px]"
                     alt="IGX Background">
            </div>
            {{-- Layer 2: Frontman (bigger) --}}
            <div class="absolute inset-0 z-30 floating-front flex items-center justify-center">
                <img src="{{ asset('media/images/illustrations/hero-front.webp') }}"
                     class="w-full max-w-[340px] sm:max-w-[440px] lg:max-w-[560px] xl:max-w-[640px]"
                     alt="IGX Characters">
            </div>
        </div>

        {{-- ===== TEXT OVERLAPPING ===== --}}
        <div class="relative z-40 -mt-12 sm:-mt-16 lg:-mt-20">
            {{-- Main title — character-by-character --}}
            <div class="mb-3">
                <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl font-extrabold uppercase text-surface leading-[0.85] flex justify-center flex-wrap gap-x-0.5"
                    style="text-shadow:
                        3px 3px 0px #F253B6,
                        6px 6px 0px #F88832,
                        9px 9px 0px #000000;">
                    @foreach(str_split('BOSS FIGHT!') as $i => $char)
                        <span class="inline-block char-float" style="animation-delay: {{ $i * 0.08 }}s">{{ $char === ' ' ? "\u{00A0}" : $char }}</span>
                    @endforeach
                </h1>
            </div>

        {{-- Subtitle + date --}}
        <div class="inline-flex flex-col sm:flex-row gap-2 sm:gap-0 mb-6">
            <div class="bg-highlight border-3 border-black px-4 py-2 sm:px-6 sm:py-3 shadow-brutal-sm rotate-[-1.5deg] slide-up" style="animation-delay: 0.5s">
                <span class="text-lg sm:text-xl md:text-2xl font-extrabold uppercase text-black">ICE BSD</span>
            </div>
            <div class="bg-surface border-3 border-black px-4 py-2 sm:px-6 sm:py-3 shadow-brutal-sm rotate-[1deg] sm:-ml-2 slide-up" style="animation-delay: 0.6s">
                <span class="text-lg sm:text-xl md:text-2xl font-extrabold uppercase text-black">24-25 OCT</span>
            </div>
            <div class="bg-accent border-3 border-black px-4 py-2 sm:px-6 sm:py-3 shadow-brutal-sm rotate-[-1deg] sm:-ml-2 slide-up" style="animation-delay: 0.7s">
                <span class="text-lg sm:text-xl md:text-2xl font-extrabold uppercase text-black">2026</span>
            </div>
        </div>

        {{-- CTA buttons --}}
        <div class="flex flex-wrap gap-3 justify-center">
            <a href="#" class="btn-brutal text-base sm:text-lg px-6 py-3 sm:px-8 sm:py-4 group relative overflow-hidden slide-up" style="animation-delay: 0.8s">
                <span class="relative z-10 flex items-center gap-2">
                    <x-heroicon-o-ticket class="w-5 h-5" />
                    GET TICKET
                </span>
            </a>
            <a href="{{ route('experiences') }}" class="btn-brutal-pink text-base sm:text-lg px-6 py-3 sm:px-8 sm:py-4 group slide-up" style="animation-delay: 0.9s">
                <span class="flex items-center gap-2">
                    <x-heroicon-o-play-circle class="w-5 h-5" />
                    PLAY NOW
                </span>
            </a>
        </div>

        {{-- Mini stats --}}
        <div class="mt-6 inline-flex gap-2">
            <div class="bg-black border-2 border-white/20 px-2 py-0.5">
                <span class="text-[9px] font-bold text-white/50 uppercase">HALL 09-10</span>
            </div>
            <div class="bg-black border-2 border-highlight/30 px-2 py-0.5">
                <span class="text-[9px] font-bold text-highlight uppercase">
                    <x-heroicon-o-user-group class="w-3 h-3 inline -mt-0.5" /> 10K+ EXPECTED
                </span>
            </div>
        </div>

        </div>{{-- end text overlap --}}

    </div>

    {{-- Bottom scroll indicator --}}
    <div class="relative z-10 pb-6 flex justify-center">
        <div class="flex flex-col items-center gap-1 animate-bounce">
            <span class="text-[8px] font-extrabold uppercase text-surface/30 tracking-[0.3em]">SCROLL</span>
            <svg class="w-4 h-4 text-surface/30" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
            </svg>
        </div>
    </div>
</div>

<style>
    @keyframes float-bg {
        0% { transform: translateY(0); }
        50% { transform: translateY(-16px); }
        100% { transform: translateY(0); }
    }
    @keyframes float-front {
        0% { transform: translateY(0); }
        50% { transform: translateY(-12px); }
        100% { transform: translateY(0); }
    }
    @keyframes char-float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-8px); }
    }
    @keyframes slide-up {
        0% { opacity: 0; transform: translateY(20px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    .floating-bg { animation: float-bg 5s ease-in-out infinite; }
    .floating-front { animation: float-front 4s ease-in-out infinite; }
    .char-float { animation: char-float 2.5s ease-in-out infinite; }
    .slide-up { animation: slide-up 0.6s ease-out both; }
</style>
