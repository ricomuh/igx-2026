{{-- Stage 03 Hero — Game HUD / Asymmetrical Layout --}}
<div class="bg-bg min-h-screen relative overflow-hidden flex flex-col">

    {{-- Halftone dots + scanlines --}}
    <div class="absolute inset-0 z-0 pointer-events-none"
         style="background:
            radial-gradient(circle, rgba(255,255,255,0.08) 1px, transparent 1px) 0 0 / 20px 20px,
            repeating-linear-gradient(0deg, transparent, transparent 2px, rgba(0,0,0,0.03) 2px, rgba(0,0,0,0.03) 4px);">
    </div>

    {{-- Giant geometric shapes --}}
    <div class="absolute top-0 right-0 w-[60%] h-full bg-primary border-l-4 border-black z-0"
         style="clip-path: polygon(25% 0, 100% 0, 100% 100%, 10% 100%);">
    </div>
    <div class="absolute top-[25%] right-[35%] w-72 h-72 bg-accent border-3 border-black rotate-12 opacity-40 z-0"></div>
    <div class="absolute bottom-[15%] left-[5%] w-48 h-48 bg-highlight border-3 border-black -rotate-6 opacity-30 z-0"></div>

    <div class="container mx-auto px-5 xl:px-12 relative z-10 flex-1 flex items-center">
        <div class="grid lg:grid-cols-2 gap-8 lg:gap-16 w-full items-center py-20 lg:py-0">

            {{-- ===== LEFT: TEXT + HUD ELEMENTS ===== --}}
            <div class="relative">

                {{-- Glitch badge top-left --}}
                <div class="absolute -top-6 -left-3 bg-black border-3 border-highlight px-3 py-1 shadow-brutal-sm rotate-[-2deg] z-20">
                    <span class="text-[10px] sm:text-xs font-extrabold text-highlight uppercase tracking-[0.2em]">STAGE 03</span>
                </div>

                {{-- Main title with layered shadows --}}
                <div class="mb-3">
                    <h1 class="text-6xl sm:text-7xl md:text-8xl lg:text-7xl xl:text-9xl font-extrabold uppercase text-surface leading-[0.85] relative z-10"
                        style="text-shadow:
                            3px 3px 0px #F253B6,
                            6px 6px 0px #F88832,
                            9px 9px 0px #000000;">
                        BOSS<br>FIGHT!
                    </h1>
                </div>

                {{-- Subtitle + date in one brutalist block --}}
                <div class="inline-flex flex-col sm:flex-row gap-2 sm:gap-0 mb-6">
                    <div class="bg-highlight border-3 border-black px-4 py-2 sm:px-6 sm:py-3 shadow-brutal-sm rotate-[-1.5deg]">
                        <span class="text-xl sm:text-2xl md:text-3xl font-extrabold uppercase text-black">ICE BSD</span>
                    </div>
                    <div class="bg-surface border-3 border-black px-4 py-2 sm:px-6 sm:py-3 shadow-brutal-sm rotate-[1deg] sm:-ml-2">
                        <span class="text-xl sm:text-2xl md:text-3xl font-extrabold uppercase text-black">24-25 OCT</span>
                    </div>
                    <div class="bg-accent border-3 border-black px-4 py-2 sm:px-6 sm:py-3 shadow-brutal-sm rotate-[-1deg] sm:-ml-2">
                        <span class="text-xl sm:text-2xl md:text-3xl font-extrabold uppercase text-black">2026</span>
                    </div>
                </div>

                {{-- HP BAR: days until event --}}
                <div class="max-w-md mb-6">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-[10px] sm:text-xs font-extrabold uppercase text-surface/60 tracking-wider">BOSS ENCOUNTER IN</span>
                        <span class="text-[10px] sm:text-xs font-extrabold text-highlight countdown days" data-countdown="2026-10-24T00:00:00Z">--</span>
                    </div>
                    <div class="h-4 border-3 border-black bg-black/30 overflow-hidden shadow-brutal-sm">
                        <div class="hp-bar h-full bg-gradient-to-r from-crimson via-primary to-highlight transition-all duration-1000"
                             style="width: 30%;"></div>
                    </div>
                    <div class="flex justify-between mt-0.5">
                        <span class="text-[8px] font-bold text-surface/40 uppercase">0</span>
                        <span class="text-[8px] font-bold text-surface/40 uppercase">365</span>
                    </div>
                </div>

                {{-- CTA buttons --}}
                <div class="flex flex-wrap gap-3">
                    <a href="#" class="btn-brutal text-base sm:text-lg px-6 py-3 sm:px-8 sm:py-4 group relative overflow-hidden">
                        <span class="relative z-10 flex items-center gap-2">
                            <x-heroicon-o-ticket class="w-5 h-5" />
                            GET TICKET
                        </span>
                    </a>
                    <a href="{{ route('experiences') }}" class="btn-brutal-pink text-base sm:text-lg px-6 py-3 sm:px-8 sm:py-4 group">
                        <span class="flex items-center gap-2">
                            <x-heroicon-o-play-circle class="w-5 h-5" />
                            PLAY NOW
                        </span>
                    </a>
                </div>

                {{-- Mini stats badge --}}
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
            </div>

            {{-- ===== RIGHT: CHARACTER + FLOATING UI ===== --}}
            <div class="relative flex items-center justify-center">
                {{-- Character frame --}}
                <div class="relative">
                    {{-- Orange bg block --}}
                    <div class="absolute -inset-8 bg-primary border-3 border-black rotate-3 z-0"></div>
                    {{-- Pink accent --}}
                    <div class="absolute -inset-4 bg-accent border-3 border-black -rotate-2 z-10"></div>
                    {{-- Image --}}
                    <div class="relative z-20 border-3 border-black overflow-hidden bg-surface-dark">
                        <img src="{{ asset('media/images/illustrations/banner.webp') }}"
                             class="w-full max-w-[380px] lg:max-w-[480px] xl:max-w-[560px] floating-igx"
                             alt="IGX Characters">
                    </div>

                    {{-- Floating HUD element: label --}}
                    <div class="absolute -top-4 -right-4 z-30 bg-highlight border-3 border-black px-3 py-1.5 shadow-brutal rotate-[3deg] animate-pulse">
                        <span class="text-xs sm:text-sm font-extrabold uppercase text-black">BOSS</span>
                    </div>

                    {{-- Floating HUD: HP label --}}
                    <div class="absolute -bottom-3 -left-3 z-30 bg-black border-2 border-crimson px-2 py-1">
                        <span class="text-[9px] font-extrabold text-crimson uppercase tracking-wider flex items-center gap-1">
                            <x-heroicon-o-shield-check class="w-3 h-3" /> LV.99
                        </span>
                    </div>
                </div>
            </div>
        </div>
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
    @keyframes float-igx {
        0% { transform: translateY(0); }
        50% { transform: translateY(-32px); }
        100% { transform: translateY(0); }
    }
    .floating-igx { animation: float-igx 3.5s ease-in-out infinite; }
</style>
