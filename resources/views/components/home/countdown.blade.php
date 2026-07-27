{{-- Countdown Section — Neo-Brutalism --}}
<div class="bg-bg border-t-4 border-black">
    <div class="container px-5 py-20 xl:py-28 mx-auto">
        {{-- Header --}}
        <div class="flex flex-col sm:flex-row gap-4 items-center justify-center mb-16 xl:mb-24">
            <div class="bg-surface border-3 border-black p-3 shadow-brutal-sm">
                <img src="{{ asset('/media/images/logos/logo.svg') }}" class="h-12 xl:h-16" alt="IGX Logo">
            </div>
            <div class="bg-highlight border-3 border-black px-6 py-3 shadow-brutal rotate-[-1deg]">
                <h1 class="font-extrabold text-center text-3xl sm:text-4xl md:text-5xl xl:text-6xl text-black uppercase">Coming Soon</h1>
            </div>
        </div>

        {{-- Countdown --}}
        <div class="flex flex-wrap gap-3 sm:gap-6 items-center justify-center text-center">
            <div class="bg-surface border-3 border-black shadow-brutal px-6 sm:px-8 py-4 sm:py-6 min-w-[100px] sm:min-w-[130px]">
                <span class="text-4xl sm:text-6xl md:text-7xl lg:text-8xl font-extrabold text-black countdown days block" data-countdown="2026-10-24T00:00:00Z">00</span>
                <span class="text-sm sm:text-lg md:text-xl font-extrabold uppercase text-secondary-lighter block mt-1">Days</span>
            </div>
            <span class="text-3xl sm:text-5xl md:text-6xl font-extrabold text-highlight" style="text-shadow: 3px 3px 0px #000000;">:</span>
            <div class="bg-surface border-3 border-black shadow-brutal px-6 sm:px-8 py-4 sm:py-6 min-w-[100px] sm:min-w-[130px]">
                <span class="text-4xl sm:text-6xl md:text-7xl lg:text-8xl font-extrabold text-black countdown hours block" data-countdown="2026-10-24T00:00:00Z">00</span>
                <span class="text-sm sm:text-lg md:text-xl font-extrabold uppercase text-secondary-lighter block mt-1">Hours</span>
            </div>
            <span class="text-3xl sm:text-5xl md:text-6xl font-extrabold text-highlight" style="text-shadow: 3px 3px 0px #000000;">:</span>
            <div class="bg-surface border-3 border-black shadow-brutal px-6 sm:px-8 py-4 sm:py-6 min-w-[100px] sm:min-w-[130px]">
                <span class="text-4xl sm:text-6xl md:text-7xl lg:text-8xl font-extrabold text-black countdown minutes block" data-countdown="2026-10-24T00:00:00Z">00</span>
                <span class="text-sm sm:text-lg md:text-xl font-extrabold uppercase text-secondary-lighter block mt-1">Minutes</span>
            </div>
            <span class="text-3xl sm:text-5xl md:text-6xl font-extrabold text-highlight" style="text-shadow: 3px 3px 0px #000000;">:</span>
            <div class="bg-surface border-3 border-black shadow-brutal px-6 sm:px-8 py-4 sm:py-6 min-w-[100px] sm:min-w-[130px]">
                <span class="text-4xl sm:text-6xl md:text-7xl lg:text-8xl font-extrabold text-black countdown seconds block" data-countdown="2026-10-24T00:00:00Z">00</span>
                <span class="text-sm sm:text-lg md:text-xl font-extrabold uppercase text-secondary-lighter block mt-1">Seconds</span>
            </div>
        </div>

        {{-- Location --}}
        <div class="bg-accent border-3 border-black shadow-brutal inline-block px-6 py-3 mx-auto mt-12 sm:mt-16 md:mt-20 rotate-[0.5deg]">
            <h2 class="font-extrabold text-2xl sm:text-3xl md:text-4xl lg:text-5xl text-center text-black uppercase">24-25 October 2026 at</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 items-center gap-8 mt-12 w-full xl:w-4/5 mx-auto">
            {{-- Map --}}
            <div class="col-span-1 border-3 border-black shadow-brutal overflow-hidden">
                <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.720459553029!2d106.6338767751508!3d-6.300414861662221!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69fb535f152305%3A0x34406ed8b098f478!2sIndonesia%20Convention%20Exhibition%20(ICE)%20BSD%20City!5e0!3m2!1sen!2sid!4v1724163747000!5m2!1sen!2sid"
                class="h-48 sm:h-56 md:h-full w-full"
                allowFullScreen
                loading="lazy"
                referrerPolicy="no-referrer-when-downgrade"
                title="ICE BSD Map"
                ></iframe>
            </div>

            {{-- Venue Info --}}
            <div class="col-span-1">
                <div class="flex flex-col gap-6">
                    <div class="bg-primary border-3 border-black shadow-brutal-sm px-5 py-3 inline-block w-max -rotate-1">
                        <h1 class="font-extrabold text-2xl sm:text-3xl lg:text-4xl text-black uppercase">IGX Venue</h1>
                    </div>
                    <p class="text-lg lg:text-xl font-bold text-surface leading-relaxed">Indonesia Convention Exhibition (ICE) Jl. BSD Grand Boulevard Raya No.1, BSD City, Tangerang, 15339</p>
                    <a target="_blank"
                       rel="noreferrer"
                       href="https://ice-indonesia.com/en/visitice/getting_here"
                       class="btn-brutal w-max text-lg px-8 py-4">
                        How To Get Here?
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
