<nav class="bg-info fixed w-full top-0 z-20">
    <div class="mx-auto px-5 xl:px-12 py-4 lg:py-2 flex items-center justify-between">
        {{-- Brand --}}
        <div class="navbar-brand flex items-center">
            <a href="{{ route('home') }}">
                <img src="{{ asset('/media/images/logos/logo.svg') }}" class="h-10 lg:h-12" alt="Logo">
            </a>
        </div>

        {{-- Hamburger Button --}}
        <button id="menu-toggle" class="text-white focus:outline-none lg:hidden cursor-pointer">
            <img id="menu-icon" src="{{ asset('media/images/icons/hamburger.svg') }}" class="w-6" alt="Menu Icon">
        </button>

        {{-- Menu List --}}
        <ul id="menu"
            class="hidden flex-col gap-5 absolute top-full left-0 w-full bg-info pt-2 p-4 lg:static lg:flex lg:flex-row lg:items-center lg:justify-end lg:gap-5 lg:p-0">
            @foreach ([
                'Home' => route("home"),
                'IGX Pals' =>  route("pals"),
                'Experience' =>  route("experiences"),
                'Guests' =>  route("guests"),
                'Rundown' =>  route("rundown"),
                'Exhibitors' =>  route("exhibitors"),
                'Promo' =>  route("promo"),
                'Gallery' =>  route("gallery"),
                'News' => route("news.index")
            ] as $name => $link)
                <li>
                    <a href="{{ $link }}" class="text-white font-extrabold uppercase block mb-4 md:mb-5 lg:mb-0 lg:text-sm xl:text-base">{{ $name }}</a>
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

            // Close menu when clicking outside
            document.addEventListener('click', function (e) {
                const target = e.target;
                if (!menu.contains(target) && !menuToggle.contains(target)) {
                    closeMenu();
                }
            });

            // Close menu when clicking on a menu link
            const menuLinks = menu.querySelectorAll('a');
            menuLinks.forEach(link => {
                link.addEventListener('click', () => {
                    closeMenu();
                });
            });

            // Add shadow class on scroll with animation
            window.addEventListener('scroll', function () {
                if (window.scrollY > 0) {
                    navbar.classList.add('shadow-lg', 'transition-shadow', 'duration-300');
                } else {
                    navbar.classList.remove('shadow-lg', 'transition-shadow', 'duration-300');
                }
            });
        });
    </script>
@endpush
