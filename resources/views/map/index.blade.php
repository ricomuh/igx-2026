@extends('layouts.main', [
    'title' => 'Event Floor Plan & Map',
    'description' => 'Denah lokasi dan booth resmi Indonesia Game Expo 2026 di ICE BSD Hall 9-10. Jelajahi zona pameran, stage, dan booth favoritmu.'
])

@push('style')
<style>
    body {
        background-color: #322366 !important;
    }

    .map-viewport {
        background-color: #1A1040;
        background-image: radial-gradient(circle, rgba(255, 255, 255, 0.08) 1.5px, transparent 1.5px);
        background-size: 20px 20px;
        touch-action: none;
        user-select: none;
        -webkit-user-select: none;
    }

    #panzoom-target {
        cursor: grab;
    }

    #panzoom-target:active {
        cursor: grabbing;
    }

    /* Modal transition */
    .qr-modal {
        transition: opacity 0.2s ease, visibility 0.2s ease;
    }
    .qr-modal.hidden {
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
    }
</style>
@endpush

@section('content')
<div class="bg-secondary min-h-screen relative overflow-hidden pb-16 font-moon">
    {{-- Background dot grid --}}
    <div class="absolute inset-0 z-0 pointer-events-none opacity-[0.06]"
         style="background-image: radial-gradient(circle, #fff 1.5px, transparent 1.5px); background-size: 20px 20px;">
    </div>

    <div class="container mx-auto px-4 sm:px-6 xl:px-12 pt-6 sm:pt-8 relative z-10">
        {{-- Page Header --}}
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-5 sm:mb-6">
            <div>
                <div class="flex items-center gap-2 mb-2 flex-wrap">
                    <span class="bg-mint text-black border-2 border-black shadow-brutal-sm text-[10px] sm:text-xs font-black uppercase px-2.5 py-0.5 rotate-[-1deg]">
                        ICE BSD · HALL 9-10
                    </span>
                    <span class="bg-accent text-white border-2 border-black shadow-brutal-sm text-[10px] sm:text-xs font-black uppercase px-2.5 py-0.5 rotate-[1deg]">
                        OFFICIAL FLOOR PLAN
                    </span>
                </div>

                <div class="bg-primary border-3 border-black shadow-brutal px-5 py-2 sm:py-3 inline-block rotate-[-0.5deg]">
                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold uppercase text-black flex items-center gap-2">
                        <span class="text-2xl sm:text-3xl">🗺️</span>
                        IGX 2026 EVENT MAP
                    </h1>
                </div>
                <p class="text-xs sm:text-sm font-bold text-surface/70 mt-2 uppercase tracking-wide">
                    Navigasi interaktif denah expo · Geser dan perbesar untuk melihat detail booth
                </p>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center gap-2 sm:gap-3 flex-wrap">
                {{-- QR Button --}}
                <button type="button" onclick="openQrModal()"
                        class="bg-highlight hover:bg-highlight/90 text-black border-3 border-black shadow-brutal-sm hover:shadow-brutal hover:-translate-x-0.5 hover:-translate-y-0.5 px-3 sm:px-4 py-2 font-black uppercase text-xs sm:text-sm flex items-center gap-2 cursor-pointer transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                    </svg>
                    <span>Scan QR</span>
                </button>

                {{-- Download Map Button --}}
                <a href="{{ asset('media/images/map/map.webp') }}" download="IGX-2026-Event-Map.webp"
                   class="bg-cyan hover:bg-cyan/90 text-black border-3 border-black shadow-brutal-sm hover:shadow-brutal hover:-translate-x-0.5 hover:-translate-y-0.5 px-3 sm:px-4 py-2 font-black uppercase text-xs sm:text-sm flex items-center gap-2 cursor-pointer transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                    </svg>
                    <span>Download</span>
                </a>
            </div>
        </div>

        {{-- Interactive Map Viewer Box --}}
        <div id="map-fullscreen-container"
             class="relative border-4 border-black shadow-brutal bg-[#1A1040] overflow-hidden"
             style="height: clamp(480px, 70vh, 840px);">

            {{-- Floating Controls Bar (Top Right) --}}
            <div class="absolute top-3 right-3 sm:top-4 sm:right-4 z-30 flex items-center gap-1 sm:gap-2 bg-surface/95 border-3 border-black shadow-brutal-sm p-1.5 sm:p-2">
                <button type="button" id="btn-zoom-in"
                        class="w-8 h-8 sm:w-9 sm:h-9 bg-primary hover:bg-highlight text-black border-2 border-black font-black text-lg flex items-center justify-center cursor-pointer transition-colors shadow-sm active:translate-y-0.5"
                        title="Zoom In (+)">
                    +
                </button>
                <div id="zoom-level" class="px-1.5 sm:px-2 text-[11px] sm:text-xs font-black text-black min-w-[46px] sm:min-w-[50px] text-center select-none">
                    100%
                </div>
                <button type="button" id="btn-zoom-out"
                        class="w-8 h-8 sm:w-9 sm:h-9 bg-primary hover:bg-highlight text-black border-2 border-black font-black text-lg flex items-center justify-center cursor-pointer transition-colors shadow-sm active:translate-y-0.5"
                        title="Zoom Out (-)">
                    &minus;
                </button>
                <div class="w-[2px] h-6 bg-black/20 mx-0.5"></div>
                <button type="button" id="btn-reset"
                        class="px-2 sm:px-2.5 h-8 sm:h-9 bg-highlight hover:bg-accent hover:text-white text-black border-2 border-black font-black text-[10px] sm:text-xs uppercase flex items-center justify-center cursor-pointer transition-colors active:translate-y-0.5"
                        title="Reset & Center View">
                    ⟲ Reset
                </button>
                <button type="button" id="btn-fullscreen"
                        class="w-8 h-8 sm:w-9 sm:h-9 bg-surface hover:bg-highlight text-black border-2 border-black font-black flex items-center justify-center cursor-pointer transition-colors active:translate-y-0.5"
                        title="Toggle Fullscreen">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15"/>
                    </svg>
                </button>
            </div>

            {{-- Floating Helper Badge (Bottom Left) --}}
            <div class="absolute bottom-3 left-3 sm:bottom-4 sm:left-4 z-20 pointer-events-none">
                <div class="bg-black/85 text-white border-2 border-white/20 px-3 py-1.5 backdrop-blur-sm shadow-md flex items-center gap-2">
                    <span class="text-highlight text-xs sm:text-sm">💡</span>
                    <span class="text-[10px] sm:text-xs font-bold tracking-wide">
                        Geser mouse / layar untuk pindah · Scroll / cubit untuk zoom
                    </span>
                </div>
            </div>

            {{-- Panzoom Viewport Canvas --}}
            <div id="panzoom-viewport" class="map-viewport w-full h-full relative overflow-hidden select-none" style="touch-action: none;">
                <div id="panzoom-target" class="absolute top-0 left-0" style="touch-action: none; transform-origin: 0 0; will-change: transform;">
                    <img id="map-image"
                         src="{{ asset('media/images/map/map.webp') }}"
                         alt="IGX 2026 Official Floor Plan"
                         class="block pointer-events-none select-none shadow-2xl"
                         draggable="false">
                </div>
            </div>
        </div>
    </div>
</div>

{{-- QR Code Modal --}}
<div id="qr-modal" class="qr-modal hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/75 backdrop-blur-sm">
    <div class="bg-surface border-4 border-black shadow-brutal max-w-sm w-full p-6 relative font-moon">
        <button type="button" onclick="closeQrModal()"
                class="absolute top-3 right-3 w-8 h-8 bg-black text-white hover:bg-accent flex items-center justify-center font-black text-lg cursor-pointer border-2 border-black transition-colors"
                aria-label="Close modal">
            &times;
        </button>

        <div class="text-center mb-4">
            <span class="bg-mint text-black border-2 border-black text-[10px] font-black uppercase px-2 py-0.5 inline-block mb-1">
                SCAN & SHARE
            </span>
            <h3 class="text-lg font-black uppercase text-black">IGX 2026 MAP LINK</h3>
            <p class="text-xs font-bold text-black/60">Scan QR berikut dengan kamera ponsel untuk membuka denah:</p>
        </div>

        <div class="bg-white border-3 border-black p-3 mb-4 flex items-center justify-center">
            <img src="{{ asset('media/images/map/map-qr.png') }}"
                 alt="QR Code Map IGX 2026"
                 class="w-64 h-auto block mx-auto">
        </div>

        <div class="flex items-center gap-2">
            <input id="qr-link-input" type="text" readonly
                   value="https://igx.co.id/map"
                   class="flex-1 bg-surface-dark border-2 border-black px-3 py-1.5 text-xs font-bold text-black select-all outline-none">
            <button type="button" onclick="copyQrLink()" id="btn-copy-link"
                    class="bg-highlight hover:bg-primary text-black border-2 border-black px-3 py-1.5 font-black text-xs uppercase cursor-pointer transition-colors">
                Salin
            </button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/panzoom.min.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const panzoomTarget = document.getElementById('panzoom-target');
    const viewport = document.getElementById('panzoom-viewport');
    const zoomLevelEl = document.getElementById('zoom-level');
    const btnZoomIn = document.getElementById('btn-zoom-in');
    const btnZoomOut = document.getElementById('btn-zoom-out');
    const btnReset = document.getElementById('btn-reset');
    const btnFullscreen = document.getElementById('btn-fullscreen');
    const fsContainer = document.getElementById('map-fullscreen-container');
    const img = document.getElementById('map-image');

    if (!panzoomTarget || typeof Panzoom === 'undefined') return;

    let panzoomInstance = null;
    let initialFitScale = 1;

    function initOrResetMap() {
        const vw = viewport.clientWidth;
        const vh = viewport.clientHeight;
        if (!vw || !vh) return;

        // Map aspect ratio from natural image dimensions (4530 x 3655)
        const natW = img.naturalWidth || 4530;
        const natH = img.naturalHeight || 3655;
        const aspect = natW / natH;

        // Base width coordinate space
        const baseW = 2400;
        const baseH = Math.round(baseW / aspect);

        panzoomTarget.style.width = baseW + 'px';
        panzoomTarget.style.height = baseH + 'px';
        img.style.width = '100%';
        img.style.height = '100%';

        // Fit whole map inside the viewport with comfortable padding
        const padX = vw < 640 ? 12 : 28;
        const padY = vh < 640 ? 12 : 28;
        const fitW = Math.max(80, vw - padX * 2);
        const fitH = Math.max(80, vh - padY * 2);

        const fitScale = Math.min(fitW / baseW, fitH / baseH);
        initialFitScale = fitScale;

        // Centered coordinates
        const renderedW = baseW * fitScale;
        const renderedH = baseH * fitScale;
        // Panzoom renders `scale(s) translate(x, y)`, so the translate values are
        // in pre-scale units: divide the screen offset by the scale.
        const startX = (vw - renderedW) / 2 / fitScale;
        const startY = (vh - renderedH) / 2 / fitScale;

        if (!panzoomInstance) {
            panzoomInstance = Panzoom(panzoomTarget, {
                origin: '0 0',
                maxScale: 6,
                minScale: Math.max(0.05, fitScale * 0.4),
                step: 0.3,
                startX: startX,
                startY: startY,
                startScale: fitScale,
                touchAction: 'none'
            });

            // Wheel zoom
            viewport.addEventListener('wheel', function(event) {
                event.preventDefault();
                panzoomInstance.zoomWithWheel(event);
            }, { passive: false });

            // Update zoom indicator: 100% means the full overview fit
            panzoomTarget.addEventListener('panzoomchange', function(e) {
                const s = e.detail.scale;
                const pct = Math.round((s / initialFitScale) * 100);
                zoomLevelEl.textContent = pct + '%';
            });

            // Double click zoom in
            viewport.addEventListener('dblclick', function(e) {
                panzoomInstance.zoomIn({ animate: true });
            });
        } else {
            panzoomInstance.setOptions({
                minScale: Math.max(0.05, fitScale * 0.4),
                startX: startX,
                startY: startY,
                startScale: fitScale
            });
            panzoomInstance.reset({ animate: true });
        }

        zoomLevelEl.textContent = '100%';
    }

    // Control buttons
    btnZoomIn.addEventListener('click', function() {
        if (panzoomInstance) panzoomInstance.zoomIn({ animate: true });
    });

    btnZoomOut.addEventListener('click', function() {
        if (panzoomInstance) panzoomInstance.zoomOut({ animate: true });
    });

    btnReset.addEventListener('click', function() {
        if (panzoomInstance) {
            initOrResetMap();
        }
    });

    // Fullscreen toggle
    btnFullscreen.addEventListener('click', function() {
        if (!document.fullscreenElement) {
            fsContainer.requestFullscreen().catch(() => {});
        } else {
            document.exitFullscreen().catch(() => {});
        }
    });

    // Fullscreen change listener to readjust fit if needed
    document.addEventListener('fullscreenchange', function() {
        setTimeout(initOrResetMap, 150);
    });

    if (img.complete && img.naturalWidth) {
        initOrResetMap();
    } else {
        img.addEventListener('load', initOrResetMap);
    }

    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(initOrResetMap, 150);
    });
});

// Modal functions
function openQrModal() {
    const modal = document.getElementById('qr-modal');
    if (modal) modal.classList.remove('hidden');
}

function closeQrModal() {
    const modal = document.getElementById('qr-modal');
    if (modal) modal.classList.add('hidden');
}

function copyQrLink() {
    const input = document.getElementById('qr-link-input');
    const btn = document.getElementById('btn-copy-link');
    if (input) {
        input.select();
        navigator.clipboard.writeText(input.value).then(() => {
            btn.textContent = 'Disalin!';
            btn.classList.add('bg-mint');
            setTimeout(() => {
                btn.textContent = 'Salin';
                btn.classList.remove('bg-mint');
            }, 2000);
        });
    }
}

// Close modal when clicking outside
document.getElementById('qr-modal')?.addEventListener('click', function(e) {
    if (e.target === this) closeQrModal();
});
</script>
@endpush
