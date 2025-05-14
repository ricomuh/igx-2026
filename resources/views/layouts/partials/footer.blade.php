<div class="relative wave-bg bg-background-footer pb-8 text-white">
    <div class="container mx-auto px-6 md:px-12">
        {{-- Header Section --}}
        <div class="flex flex-col gap-8 md:flex-row md:gap-4 justify-between items-center mb-12 xl:mb-20">
            <h1 class="text-4xl lg:text-5xl xl:text-6xl font-extrabold tracking-tight text-center md:text-left">
                Be part of <br />
                Indonesia Game Expo <br />
                2025
            </h1>
            <div class="flex flex-col gap-4 w-full sm:w-80">
                <a href="#" class="btn-primary text-center font-extrabold text-base sm:text-xl px-6 py-3 sm:px-12 sm:py-4 rounded-lg uppercase">Join Us</a>
                <a href="#" class="btn-primary text-center font-extrabold text-base sm:text-xl px-6 py-3 sm:px-12 sm:py-4 rounded-lg uppercase">Get Ticket</a>
            </div>
        </div>

        {{-- Footer Links and Social Media --}}
        <div class="flex flex-col lg:flex-row justify-between items-center gap-10 relative text-center lg:text-left">
            {{-- Left Nav --}}
            <ul class="flex flex-col gap-2 md:text-lg order-2 lg:order-1">
                @foreach (['Home' => route('home'), 'Guests' => '#', 'Rundown' => '#', 'Exhibitors' => '#', 'News' => '#'] as $name => $link)
                    <li class="hover:text-primary">
                        <a href="{{ $link }}">{{ $name }}</a>
                    </li>
                @endforeach
            </ul>

            {{-- Logo & Social Media --}}
            <div class="flex flex-col gap-6 items-center order-1 lg:order-2">
                <img src="{{ asset('/media/images/logos/logo.svg') }}" class="h-16 sm:h-20" alt="Logo">
                <div class="flex gap-6 justify-center">
                    @foreach ([
                        'whatsapp' => 'https://api.whatsapp.com/message/U3XML62HR7O2C1',
                        'instagram' => 'https://www.instagram.com/indonesiagameexpo/',
                        'facebook' => 'https://www.facebook.com/share/uxMivasQaUMuc5fZ/?mibextid=LQQJ4d',
                        'youtube' => 'https://www.youtube.com/@indonesiagameexpo'
                    ] as $platform => $url)
                        <a href="{{ $url }}" target="_blank" class="hover:scale-110 transition-transform duration-300">
                            <img src="{{ asset("/media/images/icons/{$platform}-logo.svg") }}" class="w-6 h-6" alt="{{ ucfirst($platform) }}">
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Right Nav --}}
            <ul class="flex flex-col gap-2 md:text-lg order-3 lg:order-3">
                @foreach (['Contact Us' => '#', 'Terms of Service' => '#', 'Privacy Policy' => '#'] as $name => $link)
                    <li class="hover:text-primary">
                        <a href="{{ $link }}">{{ $name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Copyright --}}
        <div class="pt-8 mt-10 text-center border-t border-white">
            <p class="text-sm sm:text-base">Copyright © {{ date('Y') }} Indonesia Game Expo. All rights reserved.</p>
        </div> 
    </div>
</div>
