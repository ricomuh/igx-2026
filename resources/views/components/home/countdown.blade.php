<div class="bg-white">
    <div class="container px-5 py-20 mx-auto">
        <div class="flex flex-col sm:flex-row gap-3 items-center justify-center mb-12 md:mb-20">
            <img src="{{ asset('/media/images/logos/logo.svg') }}" class="h-12" alt="Logo">
            <h1 class="font-extrabold text-center text-3xl sm:text-4xl md:text-5xl">COMING SOON</h1>
        </div>
        
        {{-- begin:countdown --}}
        <div class="flex flex-wrap gap-2 sm:gap-4 xl:gap-8 items-center justify-center text-center">
            <div class="flex flex-col items-center justify-center">
                <span class="text-4xl sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl font-extrabold countdown days" data-countdown="2025-10-04T00:00:00Z">00</span>
                <span class="text-sm sm:text-lg lg:text-xl md:text-2xl xl:text-4xl font-bold mt-1 xl:mt-2 lowercase">Days</span>
            </div>
            <span class="text-3xl sm:text-4xl md:text-8xl xl:text-9xl font-bold">:</span>
            <div class="flex flex-col items-center justify-center">
                <span class="text-4xl sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl font-extrabold countdown hours" data-countdown="2025-10-04T00:00:00Z">00</span>
                <span class="text-sm sm:text-lg lg:text-xl md:text-2xl xl:text-4xl font-bold mt-1 xl:mt-2 lowercase">Hours</span>
            </div>
            <span class="text-3xl sm:text-4xl md:text-8xl xl:text-9xl font-bold">:</span>
            <div class="flex flex-col items-center justify-center">
                <span class="text-4xl sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl font-extrabold countdown minutes" data-countdown="2025-10-04T00:00:00Z">00</span>
                <span class="text-sm sm:text-lg lg:text-xl md:text-2xl xl:text-4xl font-bold mt-1 xl:mt-2 lowercase">Minutes</span>
            </div>
            <span class="text-3xl sm:text-4xl md:text-8xl xl:text-9xl font-bold">:</span>
            <div class="flex flex-col items-center justify-center">
                <span class="text-4xl sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl font-extrabold countdown seconds" data-countdown="2025-10-04T00:00:00Z">00</span>
                <span class="text-sm sm:text-lg lg:text-xl md:text-2xl xl:text-4xl font-bold mt-1 xl:mt-2 lowercase">Seconds</span>
            </div>
        </div>
        {{-- end:countdown --}}
    
        {{-- begin:location --}}
        <h2 class="font-bold text-3xl sm:text-4xl md:text-5xl text-center my-8 sm:my-12 md:my-16 xl:my-20">04-05 October 2025 at</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 items-center gap-6 sm:gap-8 w-full xl:w-4/5 mx-auto">
            <div class="col-span-1">
                <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.720459553029!2d106.6338767751508!3d-6.300414861662221!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69fb535f152305%3A0x34406ed8b098f478!2sIndonesia%20Convention%20Exhibition%20(ICE)%20BSD%20City!5e0!3m2!1sen!2sid!4v1724163747000!5m2!1sen!2sid"
                class="h-48 sm:h-56 md:h-64 w-full rounded-xl"
                allowFullScreen
                loading="lazy"
                referrerPolicy="no-referrer-when-downgrade"
                title="Indonesia Convention Exhibition Map"
                ></iframe>
            </div>
            <div class="col-span-1">
                <div class="flex flex-col gap-4 md:gap-8">
                    <h1 class="font-bold text-3xl sm:text-4xl md:text-5xl">IGX Venue</h1>
                    <p class="sm:text-lg md:text-xl xl:text-2xl">Indonesia Convention Exhibition (ICE) Jl. BSD Grand Boulevard Raya No.1, BSD City, Tangerang, 15339</p>
                    <a target="_blank"
                    rel="noreferrer"
                    href="https://ice-indonesia.com/en/visitice/getting_here" class="text-lg xl:text-2xl btn-primary py-2 sm:py-3 md:py-4 px-3 sm:px-4 md:px-5 font-extrabold rounded-lg block uppercase w-max">How To Get Here?</a>
                </div>
            </div>
        </div>
        {{-- end:location --}}
    </div>
</div>

{{-- Load external JS --}}
@vite('resources/js/countdown.js')
