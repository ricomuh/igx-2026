<nav class="bg-info fixed w-full top-0">
    <div class="container px-12 py-2 flex items-center justify-between">
        <div class="navbar-brand">
            <a href="{{ route('home') }}">
                <img src="{{ asset('/media/images/logos/logo.svg') }}" class="h-12" alt="Logo" class="logo">
            </a>
        </div>
        <ul class="flex gap-5">
            @foreach ([
                'Home' => route("home"),
                'IGX Pals' => '#',
                'Experience' => '#',
                'Guests' => '#',
                'Rundown' => '#',
                'Exhibitors' => '#',
                'Promo' => '#',
                'Gallery' => '#',
                'News' => '#'
                ] as $name => $link)
                <li><a href="{{ $link }}" class="text-white font-extrabold uppercase">{{ $name }}</a></li>
            @endforeach
        </ul>
    </div>
</nav>