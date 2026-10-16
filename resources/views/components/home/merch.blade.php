@php
    $merchCategories = config('merchandise.categories');
    $merchImg = fn (string $name) => asset('media/images/merchandise/' . $name . '.webp');
    $merchCount = collect($merchCategories)->sum(fn ($c) => count($c['items']));
    // One recognisable product per category for the teaser cards.
    $merchFeatured = ['igx' => 'comic-book-card-set', 'tokidoki' => 'tokidoki-enamel-pin-set', 'chiitan' => 'chiitan-hand-puppet'];
    $merchHead = ['accent' => 'bg-accent', 'cyan' => 'bg-cyan', 'primary' => 'bg-primary'];
@endphp

{{-- ===== LOOT SHOP: Official Merchandise ===== --}}
<div id="merchandise" class="bg-secondary border-t-4 border-black relative overflow-hidden">
    <div class="absolute inset-0 z-0 pointer-events-none opacity-[0.06]"
         style="background-image: radial-gradient(circle, #fff 1px, transparent 1px); background-size: 18px 18px;">
    </div>

    <div class="container mx-auto px-5 xl:px-12 py-20 xl:py-28 relative z-10">
        <div class="flex items-center gap-4 mb-12">
            <div class="bg-black border-2 border-accent px-4 py-2 shadow-brutal-sm rotate-[-1deg]">
                <h2 class="text-lg sm:text-xl lg:text-2xl font-extrabold uppercase text-accent tracking-wider flex items-center gap-2">
                    <x-heroicon-o-shopping-bag class="w-5 h-5 sm:w-6 sm:h-6" />
                    LOOT SHOP
                </h2>
            </div>
            <div class="h-0.5 flex-1 bg-white/10"></div>
            <span class="text-[10px] font-extrabold text-surface/30 uppercase tracking-[0.3em] hidden sm:block">OFFICIAL MERCH</span>
        </div>

        <div class="grid lg:grid-cols-[minmax(0,5fr)_minmax(0,7fr)] gap-8 lg:gap-12 items-center">
            {{-- Pitch + QR --}}
            <div class="min-w-0">
                <h3 class="text-3xl sm:text-4xl xl:text-5xl font-black uppercase text-surface leading-[1.05] text-balance">
                    Official Merchandise IGX 2026
                </h3>
                <p class="text-sm sm:text-base font-bold text-surface/70 mt-4 max-w-md">
                    {{ $merchCount }} item dari IGX Official, Tokidoki, dan Chiitan☆. Cek koleksi dan harganya sebelum mampir ke booth.
                </p>

                <div class="flex items-center gap-5 mt-7 flex-wrap">
                    <a href="{{ route('merchandise') }}" class="btn-brutal-yellow px-5 py-3 text-sm sm:text-base inline-flex items-center gap-2">
                        Lihat semua merchandise
                        <x-heroicon-o-arrow-right class="w-5 h-5" />
                    </a>
                    <a href="{{ route('merchandise') }}" class="hidden md:flex items-center gap-3 group" aria-label="Scan QR untuk membuka katalog merchandise di HP">
                        <img src="{{ asset('media/images/merchandise/' . config('merchandise.qr') . '.png') }}" alt="QR code igx.co.id/merchandise"
                             width="92" height="113" loading="lazy" class="w-[92px] h-auto">
                        <span class="text-[11px] font-black uppercase text-surface/60 leading-snug group-hover:text-surface">Scan untuk<br>buka di HP</span>
                    </a>
                </div>
            </div>

            {{-- Category cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-5">
                @foreach ($merchCategories as $cat)
                    @php $from = collect($cat['items'])->min('price'); @endphp
                    <a href="{{ route('merchandise') }}#{{ $cat['key'] }}"
                       class="card-brutal group flex flex-col overflow-hidden hover:shadow-brutal-lg hover:-translate-y-1 transition-all duration-200 min-w-0">
                        <div class="{{ $merchHead[$cat['color']] }} border-b-3 border-black px-3 py-2 flex items-center justify-between gap-2">
                            <span class="text-xs sm:text-[13px] font-black uppercase text-black leading-tight">{{ $cat['short'] }}</span>
                            <x-heroicon-o-arrow-right class="w-4 h-4 text-black shrink-0 group-hover:translate-x-0.5 transition-transform" />
                        </div>
                        <div class="flex sm:flex-col">
                            <div class="bg-[#FFFBEA] w-36 shrink-0 aspect-[4/3] sm:w-auto border-r-3 sm:border-r-0 sm:border-b-3 border-black overflow-hidden">
                                <img src="{{ $merchImg($merchFeatured[$cat['key']]) }}" alt="{{ $cat['name'] }}" loading="lazy"
                                     class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300">
                            </div>
                            <div class="px-3 py-2.5 flex flex-col justify-center gap-1 min-w-0">
                                <span class="text-[10px] font-bold uppercase text-black/50">{{ count($cat['items']) }} item · mulai dari</span>
                                <span class="text-lg font-black text-black leading-none tabular-nums">Rp{{ $from }}K</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
