<div class="bg-primary bg-cover w-full min-h-screen flex items-center justify-center py-0 relative overflow-hidden">
    <video class="absolute inset-0 w-full h-full object-cover opacity-20 z-0" src="{{ asset('media/videos/banner.mp4') }}" autoplay loop muted playsinline aria-label="IGX Banner Animation" title="IGX Banner Animation"></video>
    <div class="container mx-auto relative z-10 flex flex-col justify-center">
        <div class="flex flex-col lg:flex-row lg:gap-8 w-full justify-center items-center flex-1 pt-16 sm:pt-24 xl:pt-32 pb-8 sm:pb-12">
            <div class="text-white text-center lg:text-justify" style="text-shadow: 0 4px 12px rgba(0,0,0,0.5), 0 1px 3px rgba(0,0,0,0.3);">
                <!-- Left Section -->
                <div class="flex flex-col">
                    <span class="text-5xl sm:text-6xl md:text-7xl lg:text-6xl xl:text-7xl font-extrabold">STAGE 02</span>
                    <span class="text-5xl sm:text-6xl md:text-7xl lg:text-6xl xl:text-7xl leading-none font-extrabold">FUSION !</span>
                    <span class="text-3xl sm:text-4xl md:text-5xl lg:text-[2.5rem] xl:text-5xl text-center lg:text-justify font-extrabold leading-none">Let's Team Up</span>
                </div>

                <!-- Right Section -->
                <div class="flex flex-col mt-2 lg:mt-4 xl:mt-8">
                    <div class="flex gap-2 sm:gap-3 items-center justify-center lg:justify-between md:gap-8 xl:gap-2">
                        <span class="text-4xl sm:text-5xl xl:text-6xl font-extrabold leading-none">HALL</span>
                        <span class="text-4xl sm:text-5xl xl:text-6xl font-extrabold leading-none">09-10</span>
                    </div>
                    <div class="flex gap-2 sm:gap-3 items-center justify-center lg:justify-between md:gap-8 xl:gap-2">
                        <span class="text-6xl sm:text-[4rem] md:text-7xl xl:text-8xl font-extrabold">ICE</span>
                        <span class="text-6xl sm:text-[4rem] md:text-7xl xl:text-8xl font-extrabold">BSD</span>
                    </div>
                    <span class="text-2xl sm:text-4xl xl:text-[2.75rem] font-extrabold leading-none">04-05 OCTOBER</span>
                    <span class="text-8xl sm:text-9xl xl:text-[10rem] tracking-[-0.5rem] font-extrabold leading-none">2025</span>
                </div>
            </div>

            <div class="relative w-full max-w-72 sm:max-w-80 md:max-w-96 lg:max-w-none sm:w-3/4 order-first lg:order-last md:w-2/3 lg:w-1/2 flex items-center justify-center">
                <img src="{{ asset('media/images/illustrations/banner.webp') }}" class="w-full drop-shadow-2xl floating-igx" alt="IGX Characters">
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

        <div class="flex justify-center mt-4 xl:mt-8 mb-8 sm:mb-12 md:mb-16 flex-shrink-0">
            <a href="http://blib.li/igx2025" target="_blank" class="btn-primary font-extrabold text-lg xl:text-2xl px-5 sm:px-6 md:px-7 py-3 sm:py-4 rounded-lg uppercase">Get Your Ticket!</a>
        </div>
    </div>
</div>
