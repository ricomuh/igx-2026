@extends('layouts.main', [
    'title' => 'Official Merchandise',
    'description' => 'Katalog official merchandise Indonesia Game Expo 2026: IGX Official, Tokidoki collab, dan Chiitan☆ collab. Lengkap dengan harga.'
])

@php
    $categories = config('merchandise.categories');
    $img = fn (string $name) => asset('media/images/merchandise/' . $name . '.webp');
    $catalog = $img(config('merchandise.catalog'));
    $qr = asset('media/images/merchandise/' . config('merchandise.qr') . '.png');
    $qrPrint = asset('media/images/merchandise/' . config('merchandise.qr') . '-print.png');
    // Literal class names so Tailwind picks them up.
    $headBg = ['accent' => 'bg-accent', 'cyan' => 'bg-cyan', 'primary' => 'bg-primary'];
    $count = collect($categories)->sum(fn ($c) => count($c['items']));
@endphp

@push('style')
<style>
    body { background-color: #322366 !important; }
    /* Same cream as the booth banner's product cards, so the cut-outs blend in. */
    .merch-photo { background: #FFFBEA; }
    #catalogModal, #qrModal { z-index: 99999 !important; }
</style>
@endpush

@section('content')
<div class="bg-secondary min-h-screen relative overflow-hidden pb-16 font-moon">
    <div class="absolute inset-0 z-0 pointer-events-none opacity-[0.06]"
         style="background-image: radial-gradient(circle, #fff 1.5px, transparent 1.5px); background-size: 20px 20px;">
    </div>

    <div class="container mx-auto px-4 sm:px-6 xl:px-12 pt-6 sm:pt-8 relative z-10">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-5 mb-6">
            <div class="min-w-0">
                <div class="flex items-center gap-2 mb-2 flex-wrap">
                    <span class="bg-mint text-black border-2 border-black shadow-brutal-sm text-[10px] sm:text-xs font-black uppercase px-2.5 py-0.5 rotate-[-1deg]">
                        ICE BSD · HALL 9-10
                    </span>
                    <span class="bg-highlight text-black border-2 border-black shadow-brutal-sm text-[10px] sm:text-xs font-black uppercase px-2.5 py-0.5 rotate-[1deg]">
                        {{ $count }} ITEMS
                    </span>
                </div>
                <div class="bg-accent border-3 border-black shadow-brutal px-5 py-2 sm:py-3 inline-block rotate-[-0.5deg]">
                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold uppercase text-black leading-tight flex items-center gap-2">
                        <x-heroicon-o-shopping-bag class="w-7 h-7 sm:w-8 sm:h-8 shrink-0" />
                        Official Merchandise
                    </h1>
                </div>
                <p class="text-xs sm:text-sm font-bold text-surface/70 mt-3 uppercase tracking-wide">
                    Tersedia di merch booth IGX 2026 · 24-25 Oktober
                </p>
            </div>

            <div class="flex items-center gap-2 sm:gap-3 flex-wrap">
                <button type="button" onclick="openModal('qrModal')"
                        class="bg-highlight hover:bg-highlight/90 text-black border-3 border-black shadow-brutal-sm hover:shadow-brutal hover:-translate-x-0.5 hover:-translate-y-0.5 px-3 sm:px-4 py-2 font-black uppercase text-xs sm:text-sm flex items-center gap-2 cursor-pointer transition-all">
                    <x-heroicon-o-qr-code class="w-4 h-4" /> Scan QR
                </button>
                <button type="button" onclick="openModal('catalogModal')"
                        class="bg-cyan hover:bg-cyan/90 text-black border-3 border-black shadow-brutal-sm hover:shadow-brutal hover:-translate-x-0.5 hover:-translate-y-0.5 px-3 sm:px-4 py-2 font-black uppercase text-xs sm:text-sm flex items-center gap-2 cursor-pointer transition-all">
                    <x-heroicon-o-photo class="w-4 h-4" /> Lihat katalog
                </button>
            </div>
        </div>

        {{-- Jump to category --}}
        <nav class="flex gap-2 sm:gap-3 flex-wrap mb-8" aria-label="Kategori merchandise">
            @foreach ($categories as $cat)
                <a href="#{{ $cat['key'] }}"
                   class="{{ $headBg[$cat['color']] }} text-black border-3 border-black shadow-brutal-sm hover:shadow-brutal hover:-translate-x-0.5 hover:-translate-y-0.5 transition-all px-3 py-1.5 text-[11px] sm:text-xs font-black uppercase flex items-center gap-2">
                    {{ $cat['short'] }}
                    <span class="bg-black text-surface px-1.5 py-0.5 text-[10px] leading-none">{{ count($cat['items']) }}</span>
                </a>
            @endforeach
        </nav>

        {{-- Categories --}}
        <div class="flex flex-col gap-12">
            @foreach ($categories as $cat)
                <section id="{{ $cat['key'] }}" class="scroll-mt-24">
                    <div class="{{ $headBg[$cat['color']] }} border-3 border-black shadow-brutal px-4 sm:px-6 py-3 mb-5 inline-flex max-w-full">
                        <h2 class="text-xl sm:text-2xl lg:text-3xl font-black uppercase text-black leading-tight">{{ $cat['name'] }}</h2>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-5">
                        @foreach ($cat['items'] as $item)
                            <article class="bg-surface border-3 border-black shadow-brutal-sm flex flex-col min-w-0">
                                <div class="merch-photo aspect-[4/3] border-b-3 border-black overflow-hidden">
                                    <img src="{{ $img($item['image']) }}" alt="{{ $item['name'] }}{{ $item['note'] ? ' — ' . $item['note'] : '' }}"
                                         loading="lazy" decoding="async" class="w-full h-full object-contain">
                                </div>
                                <div class="p-2.5 sm:p-3 flex-1 flex flex-col gap-2">
                                    <div class="min-w-0">
                                        <h3 class="text-[13px] sm:text-sm font-black uppercase text-black leading-snug">{{ $item['name'] }}</h3>
                                        @if ($item['note'])
                                            <p class="text-[10px] sm:text-[11px] font-bold uppercase text-black/55 leading-snug mt-0.5">{{ $item['note'] }}</p>
                                        @endif
                                    </div>
                                    <div class="mt-auto self-start bg-highlight border-2 border-black px-2 py-0.5 flex items-baseline gap-1 text-black">
                                        <span class="text-[10px] font-black">RP</span>
                                        <span class="text-lg sm:text-xl font-black leading-none tabular-nums">{{ $item['price'] }}</span>
                                        <span class="text-xs font-black">K</span>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </section>
            @endforeach
        </div>

        <p class="text-[11px] sm:text-xs font-bold text-surface/50 uppercase mt-10 text-center">
            Harga dan ketersediaan stok dapat berubah sewaktu-waktu. Info terbaru di Instagram @indonesiagameexpo.
        </p>
    </div>
</div>

{{-- Catalog (booth banner) lightbox --}}
<div id="catalogModal" class="fixed inset-0 bg-black/90 hidden flex-col items-center justify-center p-4 gap-3" onclick="closeModal('catalogModal')" role="dialog" aria-modal="true" aria-label="Katalog official merchandise">
    <div class="relative" onclick="event.stopPropagation()">
        <img data-src="{{ $catalog }}" alt="Katalog official merchandise IGX 2026"
             class="max-w-[95vw] max-h-[82vh] sm:max-h-[86vh] object-contain border-3 border-highlight shadow-brutal-lg bg-white">
        <button type="button" onclick="closeModal('catalogModal')" aria-label="Tutup"
                class="absolute -top-4 -right-4 bg-crimson border-3 border-black shadow-brutal-sm w-10 h-10 flex items-center justify-center hover:bg-accent transition-colors cursor-pointer">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="4" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>
    <div class="flex items-center gap-2 sm:gap-3 flex-wrap justify-center" onclick="event.stopPropagation()">
        <a href="{{ $catalog }}" target="_blank" rel="noopener"
           class="bg-cyan text-black border-3 border-black shadow-brutal-sm px-3 py-2 font-black uppercase text-xs sm:text-sm flex items-center gap-2">
            <x-heroicon-o-magnifying-glass-plus class="w-4 h-4" /> Buka ukuran asli
        </a>
        <a href="{{ $catalog }}" download="IGX-2026-Official-Merchandise.webp"
           class="bg-highlight text-black border-3 border-black shadow-brutal-sm px-3 py-2 font-black uppercase text-xs sm:text-sm flex items-center gap-2">
            <x-heroicon-o-arrow-down-tray class="w-4 h-4" /> Download
        </a>
    </div>
</div>

{{-- QR modal --}}
<div id="qrModal" class="fixed inset-0 bg-black/75 backdrop-blur-sm hidden items-center justify-center p-4" onclick="closeModal('qrModal')" role="dialog" aria-modal="true" aria-label="QR code merchandise">
    <div class="bg-surface border-4 border-black shadow-brutal max-w-sm w-full p-6 relative" onclick="event.stopPropagation()">
        <button type="button" onclick="closeModal('qrModal')" aria-label="Tutup"
                class="absolute top-3 right-3 w-8 h-8 bg-black text-white hover:bg-accent flex items-center justify-center font-black text-lg cursor-pointer border-2 border-black transition-colors">&times;</button>
        <div class="text-center mb-4">
            <span class="bg-accent text-black border-2 border-black text-[10px] font-black uppercase px-2 py-0.5 inline-block mb-1">SCAN & SHARE</span>
            <h3 class="text-lg font-black uppercase text-black">IGX Official Merch</h3>
            <p class="text-xs font-bold text-black/60">Scan dengan kamera HP untuk membuka katalog ini:</p>
        </div>
        <img src="{{ $qr }}" alt="QR code ke igx.co.id/merchandise" class="w-64 h-auto block mx-auto mb-4" loading="lazy">
        <div class="flex items-center gap-2">
            <input id="merchLink" type="text" readonly value="{{ route('merchandise') }}"
                   class="flex-1 min-w-0 bg-surface-dark border-2 border-black px-3 py-1.5 text-xs font-bold text-black outline-none">
            <button type="button" id="copyMerchLink" onclick="copyMerchLink()"
                    class="bg-highlight hover:bg-primary text-black border-2 border-black px-3 py-1.5 font-black text-xs uppercase cursor-pointer transition-colors">Salin</button>
        </div>
        <a href="{{ $qrPrint }}" download="IGX-2026-Merch-QR.png"
           class="mt-3 block text-center text-[11px] font-black uppercase text-black/60 underline underline-offset-2 hover:text-black">Download QR resolusi tinggi (cetak)</a>
    </div>
</div>
@endsection

@push('scripts')
<script>
function openModal(id) {
    const m = document.getElementById(id);
    m.querySelectorAll('img[data-src]').forEach(img => { img.src = img.dataset.src; img.removeAttribute('data-src'); });
    m.classList.remove('hidden'); m.classList.add('flex');
    document.body.style.overflow = 'hidden';
}
function closeModal(id) {
    const m = document.getElementById(id);
    m.classList.add('hidden'); m.classList.remove('flex');
    document.body.style.overflow = '';
}
document.addEventListener('keydown', e => { if (e.key === 'Escape') { closeModal('catalogModal'); closeModal('qrModal'); } });
function copyMerchLink() {
    const input = document.getElementById('merchLink'), btn = document.getElementById('copyMerchLink');
    const done = () => { btn.textContent = 'Disalin!'; setTimeout(() => btn.textContent = 'Salin', 2000); };
    input.select();
    if (navigator.clipboard) navigator.clipboard.writeText(input.value).then(done, () => document.execCommand('copy') && done());
    else if (document.execCommand('copy')) done();
}
</script>
@endpush
