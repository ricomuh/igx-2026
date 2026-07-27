{{-- Featured Mission: Play Game --}}
<section class="bg-surface border-t-4 border-b-4 border-black relative overflow-hidden">
    {{-- Scanline overlay --}}
    <div class="absolute inset-0 z-0 pointer-events-none opacity-[0.03]"
         style="background: repeating-linear-gradient(0deg, transparent, transparent 2px, #000 2px, #000 4px);"></div>

    <div class="container px-5 mx-auto lg:px-12 xl:px-20 py-20 xl:py-28 relative z-10">
        {{-- Mission label --}}
        <div class="flex items-center gap-3 mb-8">
            <div class="bg-crimson border-3 border-black px-3 py-1 shadow-brutal-sm rotate-[-1deg]">
                <span class="text-xs sm:text-sm font-extrabold uppercase text-white tracking-wider">MISSION 01</span>
            </div>
            <div class="h-0.5 flex-1 bg-black border-t-2 border-dashed border-black/20"></div>
            <span class="text-[10px] font-extrabold text-black/30 uppercase tracking-[0.2em]">FEATURED</span>
        </div>

        <div class="grid lg:grid-cols-5 gap-8 md:gap-12 items-center">
            {{-- Game preview — takes 3 cols --}}
            <div class="lg:col-span-3">
                <div class="relative group cursor-pointer" onclick="window.location='{{ route('experiences') }}'">
                    {{-- Frame border effect --}}
                    <div class="absolute -inset-3 bg-primary border-3 border-black rotate-1 opacity-0 group-hover:opacity-100 transition-opacity duration-200 -z-10"></div>
                    <div class="relative border-3 border-black overflow-hidden shadow-brutal">
                        <img src="{{ asset('media/images/illustrations/game1.jpg')}}"
                             class="w-full aspect-video object-cover group-hover:scale-105 transition-transform duration-500"
                             alt="IGX Game">
                        {{-- Overlay on hover --}}
                        <div class="absolute inset-0 bg-black/60 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="bg-highlight border-3 border-black px-8 py-4 shadow-brutal rotate-[-1deg] animate-pulse">
                                <span class="text-xl sm:text-2xl font-extrabold uppercase text-black flex items-center gap-2">
                                    <x-heroicon-o-play-circle class="w-7 h-7" />
                                    PRESS START
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Mission info — takes 2 cols --}}
            <div class="lg:col-span-2 space-y-5">
                <div class="bg-highlight border-3 border-black px-4 py-2 inline-block shadow-brutal-sm rotate-[-1deg]">
                    <h2 class="text-xl sm:text-2xl lg:text-3xl font-extrabold uppercase text-black leading-tight">
                        IGX Fusion<br>Celebration
                    </h2>
                </div>

                <div class="space-y-3">
                    <div class="flex gap-3 items-start">
                        <div class="bg-primary border-2 border-black p-1.5 shrink-0 mt-0.5">
                            <x-heroicon-o-gift class="w-4 h-4 text-black" />
                        </div>
                        <p class="text-sm sm:text-base font-bold text-black leading-relaxed">
                            Free ticket every <span class="bg-highlight border-2 border-black px-1.5">Monday 10 AM</span> for top leaderboard winners.
                        </p>
                    </div>
                    <div class="flex gap-3 items-start">
                        <div class="bg-accent border-2 border-black p-1.5 shrink-0 mt-0.5">
                            <x-heroicon-o-clipboard-document-check class="w-4 h-4 text-black" />
                        </div>
                        <p class="text-sm sm:text-base font-bold text-black leading-relaxed">
                            <span class="underline decoration-accent decoration-4">Previous winners</span> not eligible to win again.
                        </p>
                    </div>
                    <div class="flex gap-3 items-start">
                        <div class="bg-cyan border-2 border-black p-1.5 shrink-0 mt-0.5">
                            <x-heroicon-o-user-group class="w-4 h-4 text-black" />
                        </div>
                        <p class="text-sm sm:text-base font-bold text-black leading-relaxed">
                            <span class="bg-primary border-2 border-black px-1.5">3 winners every Monday</span> — will you be next?
                        </p>
                    </div>
                </div>

                <a href="{{ route('experiences') }}" class="btn-brutal-yellow text-lg px-8 py-4 inline-flex items-center gap-3 group">
                    START MISSION
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>
