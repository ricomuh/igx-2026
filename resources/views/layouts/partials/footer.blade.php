<div class="bg-background-footer py-20 text-white">
    <div class="container mx-auto px-12">
        {{-- Header Section --}}
        <div class="flex gap-4 justify-between items-center mb-20">
            <h1 class="text-6xl font-extrabold">
                Be part of <br />
                Indonesia Game Expo <br />
                2025
            </h1>
            <div class="flex flex-col gap-4 w-72">
                <a href="#" class="btn-primary text-center font-extrabold text-xl px-12 py-4 rounded-lg uppercase">Join Us</a>
                <a href="#" class="btn-primary text-center font-extrabold text-xl px-12 py-4 rounded-lg uppercase">Get Ticket</a>
            </div>
        </div>

        {{-- Footer Links and Social Media --}}
        <div class="flex justify-between items-center gap-5">
            {{-- Navigation Links --}}
            <ul class="flex flex-col gap-1">
                @foreach (['Home' => route('home'), 'Guests' => '#', 'Rundown' => '#', 'Exhibitors' => '#', 'News' => '#'] as $name => $link)
                    <li class="hover:text-primary">
                        <a href="{{ $link }}" class="text-lg">{{ $name }}</a>
                    </li>
                @endforeach
            </ul>

            {{-- Logo and Social Media --}}
            <div class="flex flex-col gap-5">
                <img src="{{ asset('/media/images/logos/logo.svg') }}" class="h-12" alt="Logo">
                <div class="flex gap-8">
                    @foreach ([
                        'whatsapp' => 'https://api.whatsapp.com/message/U3XML62HR7O2C1',
                        'instagram' => 'https://www.instagram.com/indonesiagameexpo/',
                        'facebook' => 'https://www.facebook.com/share/uxMivasQaUMuc5fZ/?mibextid=LQQJ4d',
                        'youtube' => 'https://www.youtube.com/@indonesiagameexpo'
                    ] as $platform => $url)
                        <a href="{{ $url }}" target="_blank" class="hover:scale-110 transition-transform duration-300">
                            <img src="{{ asset("/media/images/icons/{$platform}-logo.svg") }}" class="size-6" alt="{{ ucfirst($platform) }}">
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Additional Links --}}
            <ul class="flex flex-col gap-1 text-end">
                @foreach (['Contact Us' => '#', 'Terms of Service' => '#', 'Privacy Policy' => '#'] as $name => $link)
                    <li class="hover:text-primary">
                        <a href="{{ $link }}" class="text-lg">{{ $name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Copyright --}}
        <div class="flex justify-center items-center pt-5 mt-8 border-t border-white w-max mx-auto text-center">
            <p class="text-lg">Copyright  © {{ date('Y') }} Indonesia Game Expo. All rights reserved.</p>
        </div>
    </div>
</div>