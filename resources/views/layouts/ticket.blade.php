<!DOCTYPE html>
<html data-theme="true" data-theme-mode="light" lang="en">
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

    <body class="bg-secondary">
        {{-- Slim brand bar — no navbar/footer on ticket pages --}}
        <header class="bg-secondary border-b-3 border-black relative z-20">
            <div class="mx-auto px-5 xl:px-12 py-3 flex items-center justify-between gap-4">
                <a href="{{ route('ticket.landing') }}" class="flex items-center gap-3">
                    <span class="bg-surface border-3 border-black p-1.5 shadow-brutal-sm rotate-[-1deg]">
                        <img src="{{ asset('media/images/logos/logo-stage03-v3.webp') }}" class="h-8 sm:h-10" alt="IGX Logo">
                    </span>
                    <span class="hidden sm:block">
                        <span class="block text-[10px] font-extrabold uppercase text-secondary-lighter tracking-widest leading-tight">Indonesia Game Expo 2026</span>
                        <span class="block text-xs font-extrabold uppercase text-accent leading-tight">ICE BSD · Hall 9-10 · 24-25 Oct</span>
                    </span>
                </a>
                <nav class="flex items-center gap-2 sm:gap-3">
                    <a href="{{ route('ticket.status') }}"
                       class="bg-surface border-3 border-black px-3 py-1.5 text-[10px] sm:text-xs font-extrabold uppercase text-black shadow-brutal-sm hover:bg-highlight transition-colors">
                        Cek Status
                    </a>
                    <a href="{{ route('home') }}" target="_blank" rel="noopener"
                       class="bg-highlight border-3 border-black px-3 py-1.5 text-[10px] sm:text-xs font-extrabold uppercase text-black shadow-brutal-sm hover:bg-accent transition-colors">
                        igx.co.id
                    </a>
                </nav>
            </div>
        </header>

        <main>
            @yield('content')
        </main>

        {{-- Minimal footer — no main-site footer --}}
        <footer class="bg-black border-t-4 border-black">
            <div class="container mx-auto px-5 py-8 text-center">
                <p class="text-[10px] sm:text-xs font-extrabold uppercase text-white/50 tracking-wider">
                    Indonesia Game Expo 2026 · ICE BSD Hall 9-10 · 24-25 October 2026
                </p>
                <p class="text-[10px] font-bold uppercase text-white/30 mt-1">
                    Pertanyaan? <a href="mailto:hello@igx.co.id" class="text-accent hover:text-white transition-colors">hello@igx.co.id</a>
                </p>
            </div>
        </footer>

        @stack('scripts')
        @vite('resources/js/countdown.js')
    </body>
</html>
