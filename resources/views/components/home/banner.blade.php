{{-- Stage 03 Hero — Neo-Brutalism --}}
<div class="bg-bg w-full min-h-screen flex items-center justify-center relative overflow-hidden">
    {{-- Halftone dots bg pattern --}}
    <div class="absolute inset-0 z-0 opacity-[0.06]"
         style="background-image: radial-gradient(circle, #9A94CC 1px, transparent 1px); background-size: 24px 24px;">
    </div>

    {{-- Diagonal accent stripes --}}
    <div class="absolute -top-20 -right-20 w-96 h-96 bg-primary rotate-12 z-0 border-3 border-black opacity-20"></div>
    <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-highlight -rotate-12 z-0 border-3 border-black opacity-20"></div>

    <div class="container mx-auto relative z-10 flex flex-col justify-center px-5">
        <div class="flex flex-col lg:flex-row lg:gap-12 w-full justify-center items-center pt-20 sm:pt-28 xl:pt-36 pb-10 sm:pb-16">

            {{-- LEFT: Text Content --}}
            <div class="flex-1">
                {{-- BOSS FIGHT! — main title with pink shadow offset --}}
                <div class="relative inline-block mb-2">
                    <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-6xl xl:text-8xl font-extrabold uppercase text-surface leading-none relative z-10"
                        style="text-shadow: 4px 4px 0px #F253B6, 8px 8px 0px #000000;">
                        BOSS FIGHT!
                    </h1>
                </div>

                {{-- STAGE 03 badge --}}
                <div class="inline-block bg-highlight border-4 border-black px-5 py-2 sm:px-8 sm:py-3 mb-4 shadow-brutal rotate-[-1deg]">
                    <span class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold uppercase text-black">STAGE 03</span>
                </div>

                {{-- Date & Venue --}}
                <div class="mt-4 sm:mt-6">
                    <p class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-extrabold text-surface uppercase"
                       style="text-shadow: 3px 3px 0px #F253B6;">
                        ICE BSD
                    </p>
                    <p class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold text-highlight uppercase"
                       style="text-shadow: 3px 3px 0px #000000;">
                        24-25 OCTOBER
                    </p>
                    <p class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-extrabold text-surface leading-none"
                       style="text-shadow: 4px 4px 0px #F253B6;">
                        2026
                    </p>
                </div>

                {{-- CTA --}}
                <div class="flex flex-wrap gap-4 mt-6 sm:mt-8">
                    <a href="#" class="btn-brutal text-lg sm:text-xl md:text-2xl px-8 py-4">
                        Get Your Ticket!
                    </a>
                    <a href="{{ route('experiences') }}" class="btn-brutal-pink text-lg sm:text-xl md:text-2xl px-8 py-4">
                        Play Game
                    </a>
                </div>
            </div>

            {{-- RIGHT: Character Image --}}
            <div class="relative w-full max-w-xs sm:max-w-sm md:max-w-md lg:max-w-lg xl:max-w-xl mt-8 lg:mt-0 flex items-center justify-center">
                <div class="relative">
                    {{-- Orange splash behind character --}}
                    <div class="absolute inset-0 bg-primary border-3 border-black rotate-6 scale-90 -z-10"></div>
                    {{-- Pink splash --}}
                    <div class="absolute inset-0 bg-accent border-3 border-black -rotate-3 scale-95 -z-20"></div>
                    {{-- Image --}}
                    <img src="{{ asset('media/images/illustrations/banner.webp') }}"
                         class="w-full drop-shadow-2xl floating-igx relative z-10 border-3 border-black"
                         alt="IGX Stage 03 Characters">
                </div>
                <style>
                    @keyframes float-igx {
                        0% { transform: translateY(0); }
                        50% { transform: translateY(-32px); }
                        100% { transform: translateY(0); }
                    }
                    .floating-igx {
                        animation: float-igx 3.5s ease-in-out infinite;
                    }
                </style>
            </div>
        </div>
    </div>
</div>
