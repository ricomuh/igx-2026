{{-- Footer — Neo-Brutalism Game Menu Style --}}
<div class="bg-secondary border-t-4 border-black text-surface relative overflow-hidden">
    {{-- Halftone dots bg pattern — like hero --}}
    <div class="absolute inset-0 z-0 opacity-[0.06] pointer-events-none"
         style="background-image: radial-gradient(circle, #9A94CC 1px, transparent 1px); background-size: 20px 20px;">
    </div>

    {{-- Diagonal accent stripes --}}
    <div class="absolute top-10 -right-16 w-72 h-8 bg-accent rotate-[6deg] border-2 border-black opacity-30 z-0"></div>
    <div class="absolute bottom-32 -left-16 w-80 h-8 bg-highlight -rotate-[8deg] border-2 border-black opacity-30 z-0"></div>

    <div class="container mx-auto px-5 md:px-12 py-16 xl:py-24 relative z-10">
        {{-- Header Section --}}
        <div class="flex flex-col gap-8 md:flex-row md:gap-4 justify-between items-center mb-14 xl:mb-20">
            <div class="bg-accent border-3 border-black shadow-brutal-sm px-6 py-5 rotate-[-1deg]">
                <h1 class="text-2xl lg:text-4xl xl:text-5xl font-extrabold text-center md:text-left uppercase text-black leading-tight">
                    Be part of <br />
                    Indonesia Game Expo <br />
                    <span class="text-highlight" style="text-shadow: 2px 2px 0px #000000;">2026</span>
                </h1>
            </div>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="https://www.instagram.com/indonesiagameexpo/" target="_blank"
                   class="btn-brutal text-base xl:text-lg px-8 py-3">
                    Join Us
                </a>
                <a href="#" class="btn-brutal-yellow text-base xl:text-lg px-8 py-3">
                    Get Ticket
                </a>
            </div>
        </div>

        {{-- Footer Links and Social Media --}}
        <div class="flex flex-col lg:flex-row justify-between items-center gap-10 relative text-left">
            {{-- LEFT: Game Menu Links --}}
            <ul class="flex flex-col gap-1 order-2 lg:order-1 min-w-[200px]">
                <li class="text-xs font-extrabold uppercase tracking-[0.2em] text-highlight/60 mb-2 pl-2">Main Menu</li>
                @foreach (['Home' => route('home'), 'Guests' => route("guests"), 'Rundown' => route("rundown"), 'Exhibitors' => route("exhibitors"), 'News' => route("news.index")] as $name => $link)
                    <li>
                        <a href="{{ $link }}"
                           class="group flex items-center gap-2 font-extrabold text-base uppercase py-2 px-3 border-2 border-transparent hover:border-black hover:bg-surface hover:text-black transition-all duration-150">
                            {{-- Triangle pointer — appears on hover --}}
                            <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-150 shrink-0 text-highlight"
                                  style="text-shadow: 2px 2px 0px #000000;">
                                &#x25B6;
                            </span>
                            <span>{{ $name }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>

            {{-- CENTER: Logo & Social Media --}}
            <div class="flex flex-col gap-6 items-center order-1 lg:order-2">
                <div class="bg-surface border-3 border-black p-4 shadow-brutal-sm">
                    <img src="{{ asset('/media/images/logos/logo-stage03.webp') }}" class="h-16 sm:h-20" alt="IGX Logo">
                </div>
                <p class="text-xs font-extrabold uppercase tracking-widest text-surface/60">Follow Us</p>
                <div class="flex gap-4 justify-center">
                    @php
                        $socials = [
                            ['platform' => 'whatsapp', 'url' => 'https://api.whatsapp.com/message/U3XML62HR7O2C1', 'bg' => 'bg-mint', 'icon_color' => ''],
                            ['platform' => 'instagram', 'url' => 'https://www.instagram.com/indonesiagameexpo/', 'bg' => 'bg-accent', 'icon_color' => ''],
                            ['platform' => 'facebook', 'url' => 'https://www.facebook.com/share/uxMivasQaUMuc5fZ/?mibextid=LQQJ4d', 'bg' => 'bg-primary', 'icon_color' => ''],
                            ['platform' => 'youtube', 'url' => 'https://www.youtube.com/@indonesiagameexpo', 'bg' => 'bg-crimson', 'icon_color' => 'brightness-0 invert'],
                        ];
                    @endphp
                    @foreach ($socials as $s)
                        <a href="{{ $s['url'] }}" target="_blank"
                           class="{{ $s['bg'] }} border-3 border-black shadow-brutal-sm p-2.5 hover:shadow-brutal hover:-translate-y-1 transition-all duration-200 group">
                            <img src="{{ asset('/media/images/icons/' . $s['platform'] . '-logo.svg') }}"
                                 class="w-5 h-5 {{ $s['icon_color'] }}"
                                 alt="{{ ucfirst($s['platform']) }}">
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- RIGHT: Game Menu Links --}}
            <ul class="flex flex-col gap-1 order-3 min-w-[200px]">
                <li class="text-xs font-extrabold uppercase tracking-[0.2em] text-highlight/60 mb-2 pl-2">Info</li>
                @foreach (['Contact Us' => route('contact-us'), 'Terms of Service' => route('terms-of-service'), 'Privacy Policy' => route('privacy-policy')] as $name => $link)
                    <li>
                        <a href="{{ $link }}"
                           class="group flex items-center gap-2 font-extrabold text-base uppercase py-2 px-3 border-2 border-transparent hover:border-black hover:bg-surface hover:text-black transition-all duration-150">
                            <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-150 shrink-0 text-highlight"
                                  style="text-shadow: 2px 2px 0px #000000;">
                                &#x25B6;
                            </span>
                            <span>{{ $name }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Copyright --}}
        <div class="pt-8 mt-12 text-center border-t-3 border-surface/30">
            <p class="text-sm sm:text-base font-bold text-surface/80">Copyright © {{ date('Y') }} Indonesia Game Expo. All rights reserved.</p>
        </div>
    </div>
</div>
