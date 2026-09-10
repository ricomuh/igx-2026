{{-- Featured Missions: IGX Experience & IGX Card Generator --}}
<section class="bg-surface border-t-4 border-b-4 border-black relative overflow-hidden">
    {{-- Scanline overlay --}}
    <div class="absolute inset-0 z-0 pointer-events-none opacity-[0.03]"
         style="background: repeating-linear-gradient(0deg, transparent, transparent 2px, #000 2px, #000 4px);"></div>

    <div class="container px-5 mx-auto lg:px-12 xl:px-20 py-16 xl:py-24 relative z-10">
        {{-- Section Header --}}
        <div class="flex items-center gap-3 mb-10">
            <div class="bg-crimson border-3 border-black px-3 py-1 shadow-brutal-sm rotate-[-1deg]">
                <span class="text-xs sm:text-sm font-extrabold uppercase text-white tracking-wider">FEATURED MISSIONS</span>
            </div>
            <div class="h-0.5 flex-1 bg-black border-t-2 border-dashed border-black/20"></div>
            <div class="flex items-center gap-2">
                <span class="text-[10px] font-extrabold text-black/30 uppercase tracking-[0.2em]">INTERACTIVE STAGE</span>
            </div>
        </div>

        <div class="grid lg:grid-cols-2 gap-8 lg:gap-10 items-stretch">

            {{-- LEFT: IGX Experience Game --}}
            <div class="card-brutal bg-white p-6 sm:p-8 flex flex-col justify-between group hover:shadow-brutal-lg transition-all duration-200">
                <div>
                    {{-- Badge --}}
                    <div class="flex justify-between items-center mb-4">
                        <div class="bg-accent border-2 border-black px-2.5 py-0.5 shadow-brutal-sm rotate-[-1deg]">
                            <span class="text-xs font-extrabold uppercase text-black">STAGE 01 · GAME</span>
                        </div>
                        <span class="text-[10px] font-extrabold uppercase text-black/40 tracking-wider">MINI GAME</span>
                    </div>

                    {{-- Image Preview --}}
                    <div class="relative group/img cursor-pointer mb-5 border-3 border-black overflow-hidden shadow-brutal aspect-video"
                         onclick="window.location='{{ route('experiences') }}'">
                        <img src="{{ asset('media/images/illustrations/game1.jpg')}}"
                             class="w-full h-full object-cover group-hover/img:scale-105 transition-transform duration-500"
                             alt="IGX Game">
                        <div class="absolute inset-0 bg-black/60 flex items-center justify-center opacity-0 group-hover/img:opacity-100 transition-opacity duration-300">
                            <div class="bg-highlight border-3 border-black px-6 py-3 shadow-brutal rotate-[-1deg]">
                                <span class="text-lg font-extrabold uppercase text-black flex items-center gap-2">
                                    <x-heroicon-o-play-circle class="w-6 h-6" />
                                    PRESS START
                                </span>
                            </div>
                        </div>
                    </div>

                    <h2 class="text-xl sm:text-2xl font-extrabold uppercase text-black leading-tight mb-3">
                        IGX Fusion Celebration
                    </h2>

                    <p class="text-xs sm:text-sm font-bold text-black/70 leading-relaxed mb-4">
                        Play the game, climb the leaderboard, and win free IGX 2026 event tickets every Monday!
                    </p>
                </div>

                <a href="{{ route('experiences') }}" class="btn-brutal-yellow text-sm sm:text-base px-6 py-3.5 inline-flex items-center justify-center gap-2 group/btn w-full">
                    PLAY & WIN TICKETS
                    <svg class="w-4 h-4 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </a>
            </div>

            {{-- RIGHT: IGX Card Generator --}}
            <div class="card-brutal bg-white p-6 sm:p-8 flex flex-col justify-between group hover:shadow-brutal-lg transition-all duration-200">
                <div class="flex flex-col sm:flex-row gap-5 sm:gap-6 items-center sm:items-start flex-1 mb-5">
                    {{-- Full uncropped card image (portrait 4:5) --}}
                    <div class="w-40 sm:w-44 md:w-48 shrink-0 relative group/img cursor-pointer"
                         onclick="window.location='{{ route('card-maker') }}'">
                        <div class="border-3 border-black shadow-brutal aspect-[4/5] overflow-hidden bg-secondary">
                            <img src="{{ asset('media/images/card-maker/preview.webp') }}"
                                 class="w-full h-full object-contain group-hover/img:scale-105 transition-transform duration-300"
                                 alt="IGX Card Generator Preview">
                        </div>
                    </div>

                    {{-- Card Info --}}
                    <div class="flex-1 flex flex-col justify-between h-full text-center sm:text-left">
                        <div>
                            {{-- Badge --}}
                            <div class="flex justify-center sm:justify-between items-center mb-3">
                                <div class="bg-highlight border-2 border-black px-2.5 py-0.5 shadow-brutal-sm rotate-[1deg]">
                                    <span class="text-xs font-extrabold uppercase text-black">STAGE 02 · CARD MAKER</span>
                                </div>
                            </div>

                            <h2 class="text-xl sm:text-2xl font-extrabold uppercase text-black leading-tight mb-2">
                                IGX Card Generator
                            </h2>

                            <p class="text-xs sm:text-sm font-bold text-black/70 leading-relaxed mb-3">
                                "Turn yourself into a collectible card!"
                            </p>

                            <p class="text-[11px] sm:text-xs font-bold text-black/50 uppercase leading-relaxed">
                                Upload your photo, crop, customize name & backstory, then download your official IGX 2026 collectible card!
                            </p>
                        </div>
                    </div>
                </div>

                <a href="{{ route('card-maker') }}" class="btn-brutal text-sm sm:text-base bg-accent px-6 py-3.5 inline-flex items-center justify-center gap-2 group/btn w-full">
                    MAKE YOUR IGX CARD
                    <svg class="w-4 h-4 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </a>
            </div>

        </div>
    </div>
</section>