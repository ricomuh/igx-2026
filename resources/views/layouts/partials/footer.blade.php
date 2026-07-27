{{-- Footer — Neo-Brutalism --}}
<div class="bg-secondary border-t-4 border-black text-surface">
    <div class="container mx-auto px-5 md:px-12 py-16 xl:py-24">
        {{-- Header Section --}}
        <div class="flex flex-col gap-8 md:flex-row md:gap-4 justify-between items-center mb-12 xl:mb-20">
            <div class="bg-accent border-3 border-black shadow-brutal-sm px-6 py-5 rotate-[-1deg]">
                <h1 class="text-2xl lg:text-4xl xl:text-5xl font-extrabold text-center md:text-left uppercase text-black leading-tight">
                    Be part of <br />
                    Indonesia Game Expo <br />
                    <span class="text-highlight" style="text-shadow: 2px 2px 0px #000000;">2026</span>
                </h1>
            </div>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="https://www.instagram.com/indonesiagameexpo/" target="_blank"
                   class="btn-brutal text-base xl:text-lg px-6 py-3">
                    Join Us
                </a>
                <a href="#" class="btn-brutal-yellow text-base xl:text-lg px-6 py-3">
                    Get Ticket
                </a>
            </div>
        </div>

        {{-- Footer Links and Social Media --}}
        <div class="flex flex-col lg:flex-row justify-between items-center gap-10 relative text-center lg:text-left">
            {{-- Left Nav --}}
            <ul class="flex flex-col gap-2 text-lg font-bold order-2 lg:order-1">
                @foreach (['Home' => route('home'), 'Guests' => route("guests"), 'Rundown' => route("rundown"), 'Exhibitors' => route("exhibitors"), 'News' => route("news.index")] as $name => $link)
                    <li>
                        <a href="{{ $link }}" class="hover:text-highlight transition-colors uppercase">{{ $name }}</a>
                    </li>
                @endforeach
            </ul>

            {{-- Logo & Social Media --}}
            <div class="flex flex-col gap-6 items-center order-1 lg:order-2">
                <div class="bg-surface border-3 border-black p-4 shadow-brutal-sm">
                    <img src="{{ asset('/media/images/logos/logo.svg') }}" class="h-14 sm:h-18" alt="IGX Logo">
                </div>
                <div class="flex gap-5 justify-center">
                    @foreach ([
                        'whatsapp' => 'https://api.whatsapp.com/message/U3XML62HR7O2C1',
                        'instagram' => 'https://www.instagram.com/indonesiagameexpo/',
                        'facebook' => 'https://www.facebook.com/share/uxMivasQaUMuc5fZ/?mibextid=LQQJ4d',
                        'youtube' => 'https://www.youtube.com/@indonesiagameexpo'
                    ] as $platform => $url)
                        <a href="{{ $url }}" target="_blank"
                           class="bg-surface border-2 border-black p-2 hover:bg-highlight hover:shadow-brutal-sm transition-all duration-200">
                            <img src="{{ asset("/media/images/icons/{$platform}-logo.svg") }}" class="w-5 h-5" alt="{{ ucfirst($platform) }}">
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Right Nav --}}
            <ul class="flex flex-col gap-2 text-lg font-bold order-3">
                @foreach (['Contact Us' => route('contact-us'), 'Terms of Service' => route('terms-of-service'), 'Privacy Policy' => route('privacy-policy')] as $name => $link)
                    <li>
                        <a href="{{ $link }}" class="hover:text-highlight transition-colors uppercase">{{ $name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Copyright --}}
        <div class="pt-8 mt-12 text-center border-t-3 border-surface/30">
            <p class="text-sm sm:text-base font-bold">Copyright © {{ date('Y') }} Indonesia Game Expo. All rights reserved.</p>
        </div>
    </div>
</div>
