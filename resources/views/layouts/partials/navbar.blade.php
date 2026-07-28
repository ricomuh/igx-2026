{{-- Navbar — Neo-Brutalism --}}
<nav class="bg-bg fixed w-full top-0 z-20 border-b-3 border-black">
    <div class="mx-auto px-5 xl:px-12 py-4 lg:py-3 flex items-center justify-between">
        {{-- Brand --}}
        <div class="navbar-brand flex items-center">
            <a href="{{ route('home') }}">
                <img src="{{ asset('/media/images/logos/logo-stage03-v3.webp') }}" class="h-10 lg:h-12" alt="IGX Logo">
            </a>
        </div>

        {{-- Hamburger Button --}}
        <button id="menu-toggle" class="text-surface focus:outline-none lg:hidden cursor-pointer bg-secondary border-3 border-black p-2 shadow-brutal-sm">
            <img id="menu-icon" src="{{ asset('media/images/icons/hamburger.svg') }}" class="w-5 brightness-0 invert" alt="Menu">
        </button>

        {{-- Menu List --}}
        <ul id="menu"
            class="hidden flex-col gap-4 absolute top-full left-0 w-full bg-bg border-b-3 border-black pt-4 p-5 lg:static lg:flex lg:flex-row lg:items-center lg:justify-end lg:gap-3 lg:p-0 lg:border-b-0">
            @foreach ([
                'Home' => route("home"),
                'G.I.X Squad' =>  route("pals"),
                'Experience' =>  route("experiences"),
                'Rundown' =>  route("rundown"),
                'Promo' =>  route("promo"),
                'Gallery' =>  route("gallery"),
                'News' => route("news.index")
            ] as $name => $link)
                @php
                    $isActive = url()->current() === $link || (request()->routeIs('news.*') && $name === 'News');
                @endphp
                <li>
                    <a href="{{ $link }}"
                       class="font-extrabold uppercase block text-sm xl:text-base px-3 py-2 border-3 border-black transition-all duration-150
                              {{ $isActive
                                  ? 'bg-highlight text-black shadow-brutal-sm'
                                  : 'bg-surface text-black hover:bg-highlight hover:shadow-brutal-sm' }}">
                        {{ $name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</nav>

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const menuToggle = document.getElementById('menu-toggle');
            const menu = document.getElementById('menu');
            const menuIcon = document.getElementById('menu-icon');
            const navbar = document.querySelector('nav');

            const hamburgerIcon = '/media/images/icons/hamburger.svg';
            const xmarkIcon = '/media/images/icons/xmark.svg';

            const closeMenu = () => {
                menu.classList.add('hidden');
                menuIcon.src = hamburgerIcon;
            }

            const openMenu = () => {
                menu.classList.remove('hidden');
                menuIcon.src = xmarkIcon;
            }

            menuToggle.addEventListener('click', function (e) {
                e.stopPropagation();
                if (menu.classList.contains('hidden')) {
                    openMenu();
                } else {
                    closeMenu();
                }
            });

            document.addEventListener('click', function (e) {
                const target = e.target;
                if (!menu.contains(target) && !menuToggle.contains(target)) {
                    closeMenu();
                }
            });

            const menuLinks = menu.querySelectorAll('a');
            menuLinks.forEach(link => {
                link.addEventListener('click', () => {
                    closeMenu();
                });
            });
        });
    </script>
@endpush
