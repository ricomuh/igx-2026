<div class="bg-primary bg-cover w-full min-h-screen flex items-center justify-center py-20">
    <div class="container mx-auto overflow-hidden">
        <div class="flex flex-col lg:flex-row lg:gap-8 w-full justify-center items-center">
            <div class="text-white sm:p-10 text-center lg:text-justify">
                <!-- Left Section -->
                <div class="flex flex-col">
                    <span class="text-5xl sm:text-6xl md:text-7xl lg:text-6xl xl:text-7xl font-extrabold">STAGE 02</span>
                    <span class="text-5xl sm:text-6xl md:text-7xl lg:text-6xl xl:text-7xl leading-[1] font-extrabold">FUSION !</span>
                    <span class="text-3xl sm:text-4xl md:text-5xl lg:text-[2.5rem] xl:text-5xl text-center lg:text-justify font-extrabold leading-[1]">Let's Team Up</span>
                </div>

                <!-- Right Section -->
                <div class="flex flex-col mt-2 lg:mt-4 xl:mt-8">
                    <div class="flex gap-2 sm:gap-3 items-center justify-center lg:justify-between md:gap-8 xl:gap-2">
                        <span class="text-4xl sm:text-5xl xl:text-6xl font-extrabold leading-[1]">HALL</span>
                        <span class="text-4xl sm:text-5xl xl:text-6xl font-extrabold leading-[1]">09-10</span>
                    </div>
                    <div class="flex gap-2 sm:gap-3 items-center justify-center lg:justify-between md:gap-8 xl:gap-2">
                        <span class="text-6xl sm:text-[4rem] md:text-7xl xl:text-8xl font-extrabold">ICE</span>
                        <span class="text-6xl sm:text-[4rem] md:text-7xl xl:text-8xl font-extrabold">BSD</span>
                    </div>
                    <span class="text-2xl sm:text-4xl xl:text-[2.75rem] font-extrabold leading-[1]">04-05 OCTOBER</span>
                    <span class="text-8xl sm:text-9xl xl:text-[10rem] tracking-[-0.5rem] font-extrabold leading-[1]">2025</span>
                </div>
            </div>

            <img src="{{ asset('media/images/illustrations/banner.webp') }}" class="w-full max-w-72 sm:max-w-80 md:max-w-96 lg:max-w-none sm:w-3/4 order-first lg:order-last md:w-2/3 lg:w-1/2" alt="">
        </div>

        <div class="flex justify-center mt-8 xl:mt-12">
            <a href="{{ route('promo') }}" class="btn-primary font-extrabold text-lg xl:text-2xl px-5 sm:px-6 md:px-7 py-3 sm:py-4 rounded-lg uppercase">Get Your Ticket!</a>
        </div>
    </div>
</div>
