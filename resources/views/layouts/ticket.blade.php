<!DOCTYPE html>
<html data-theme="true" data-theme-mode="dark" lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>{{ @$title ? $title . ' | ' : '' }}{{ config('app.name') }}</title>

        <meta name="description" content="Beli tiket Indonesia Game Expo 2026 — ICE BSD, Hall 9-10, 24-25 Oktober 2026.">

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite('resources/css/app.css')
        @endif
        <link rel="stylesheet" href="/font-css">

        @stack('style')
    </head>
    <body class="bg-secondary min-h-screen flex flex-col">
        {{-- ===== BANNER — logo + graphic + event info (no navbar/footer) ===== --}}
        <header class="relative overflow-hidden border-b-2 border-black/30">
            {{-- Graphic layer --}}
            <div class="absolute inset-0 z-0 pointer-events-none">
                <img src="{{ asset('media/images/illustrations/hero-bg.webp') }}"
                     class="w-full h-full object-cover opacity-25"
                     alt="">
                <img src="{{ asset('media/images/illustrations/hero-front.webp') }}"
                     class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[80%] max-w-3xl opacity-50 pointer-events-none"
                     alt="">
            </div>
            {{-- Readability gradient --}}
            <div class="absolute inset-0 z-0 bg-gradient-to-b from-black/25 via-transparent to-secondary pointer-events-none"></div>

            <div class="relative z-10 container mx-auto px-5 xl:px-12 py-6 sm:py-10">
                <div class="flex items-center justify-between gap-4">
                    <a href="{{ route('ticket.landing') }}" class="shrink-0">
                        <img src="{{ asset('media/images/logos/logo-stage03-v3.webp') }}" class="h-12 sm:h-16 lg:h-20" alt="IGX Logo">
                    </a>
                    <div class="text-right">
                        <p class="text-[11px] sm:text-sm font-extrabold uppercase text-highlight tracking-widest">Indonesia Game Expo 2026</p>
                        <p class="text-xs sm:text-base font-extrabold uppercase text-accent tracking-wider mt-0.5">ICE BSD · Hall 9-10 · 24-25 Oct</p>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1">
            @yield('content')
        </main>

        {{-- Slim footer --}}
        <footer class="bg-black/60 border-t-2 border-black/30 py-5 text-center">
            <p class="text-[10px] sm:text-xs font-extrabold uppercase text-white/50 tracking-wider">
                Indonesia Game Expo 2026 · <a href="mailto:hello@igx.co.id" class="text-accent hover:text-white transition-colors">hello@igx.co.id</a>
            </p>
        </footer>

        @stack('scripts')
        @vite('resources/js/countdown.js')
    </body>
</html>
