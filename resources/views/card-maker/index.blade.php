@extends('layouts.main', [
    'title' => 'Card Maker',
    'description' => 'Create your own IGX 2026 card!',
])

@push('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.css" />
<style>
body { background-color: #322366 !important; }

.char-bg-pattern {
    background-image: radial-gradient(circle, #9A94CC 1px, transparent 1px);
    background-size: 20px 20px;
}

#cropper-modal {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.85);
    z-index: 9999;
    align-items: center;
    justify-content: center;
}
#cropper-modal.active { display: flex; }

#crop-image-el {
    max-width: 100%;
    max-height: 70vh;
    display: block;
}

.char-count { font-size: 11px; font-weight: 700; }
.char-count.warn { color: #F253B6; }
</style>
@endpush

@section('content')
<div class="bg-secondary min-h-screen relative overflow-hidden char-bg-pattern">
    {{-- Decorative stripes --}}
    <div class="absolute top-10 -left-20 w-80 h-20 bg-highlight rotate-[-8deg] border-3 border-black opacity-30 z-0"></div>
    <div class="absolute bottom-20 -right-20 w-96 h-16 bg-accent rotate-[6deg] border-3 border-black opacity-30 z-0"></div>

    <div class="container mx-auto px-4 sm:px-5 xl:px-12 pt-20 sm:pt-28 pb-16 relative z-10">

        {{-- Header --}}
        <div class="flex flex-col items-center mb-8 sm:mb-12">
            <div class="bg-accent border-3 border-black shadow-brutal px-4 py-2 sm:px-10 sm:py-4 rotate-[-1.5deg] mb-2">
                <h1 class="text-lg sm:text-3xl md:text-4xl font-extrabold uppercase text-black text-center leading-none">
                    CREATE YOUR
                </h1>
            </div>
            <div class="bg-highlight border-3 border-black shadow-brutal px-4 py-2 sm:px-10 sm:py-4 rotate-[1deg]">
                <h1 class="text-xl sm:text-4xl md:text-5xl font-extrabold uppercase text-black text-center leading-none"
                    style="text-shadow: 3px 3px 0px #F253B6;">
                    IGX CARD!
                </h1>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-8 xl:gap-12 items-start justify-center">

            {{-- LEFT: Form --}}
            <div class="w-full lg:max-w-sm xl:max-w-md">
                <div class="card-brutal bg-surface p-5 sm:p-6">

                    {{-- Photo Upload --}}
                    <div class="mb-5">
                        <label class="block text-xs font-extrabold uppercase text-black mb-2 tracking-wider">
                            Your Photo
                        </label>
                        <div id="upload-area"
                             class="border-3 border-dashed border-black bg-surface-dark flex flex-col items-center justify-center gap-2 py-8 px-4 cursor-pointer hover:bg-highlight/10 transition-colors"
                             onclick="document.getElementById('photo-input').click()">
                            <span class="text-3xl">📷</span>
                            <span class="text-xs font-bold text-black uppercase text-center">Click to upload photo</span>
                            <span class="text-[10px] text-black/50 font-bold uppercase">JPG, PNG, WEBP</span>
                        </div>
                        <input type="file" id="photo-input" accept="image/*" class="hidden">

                        {{-- Crop preview thumbnail --}}
                        <div id="crop-thumb-wrap" class="mt-3 hidden">
                            <div class="flex items-center gap-3">
                                <div class="border-2 border-black overflow-hidden w-16 h-20 shrink-0 bg-surface-dark">
                                    <img id="crop-thumb" class="w-full h-full object-cover" src="" alt="Cropped">
                                </div>
                                <div class="flex flex-col gap-1.5">
                                    <span class="text-[10px] font-extrabold uppercase text-black">Photo set ✓</span>
                                    <button type="button" onclick="document.getElementById('photo-input').click()"
                                        class="btn-brutal text-[10px] py-1 px-2">
                                        Change
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Name --}}
                    <div class="mb-5">
                        <div class="flex justify-between items-center mb-2">
                            <label class="block text-xs font-extrabold uppercase text-black tracking-wider">
                                Name
                            </label>
                            <span id="name-count" class="char-count">0/20</span>
                        </div>
                        <input type="text" id="input-name" maxlength="20"
                               placeholder="Your name..."
                               class="w-full border-3 border-black px-3 py-2 text-sm font-bold bg-surface focus:outline-none focus:bg-highlight/10"
                               oninput="updateCount('input-name','name-count',20); renderCard()">
                    </div>

                    {{-- Description --}}
                    <div class="mb-6">
                        <div class="flex justify-between items-center mb-2">
                            <label class="block text-xs font-extrabold uppercase text-black tracking-wider">
                                Description
                            </label>
                            <span id="desc-count" class="char-count">0/200</span>
                        </div>
                        <textarea id="input-desc" maxlength="200" rows="4"
                                  placeholder="Describe yourself..."
                                  class="w-full border-3 border-black px-3 py-2 text-sm font-bold bg-surface focus:outline-none focus:bg-highlight/10 resize-none"
                                  oninput="updateCount('input-desc','desc-count',200); renderCard()"></textarea>
                    </div>

                    {{-- Download --}}
                    <button id="btn-download" onclick="downloadCard()"
                        class="btn-brutal w-full py-3 text-sm font-extrabold uppercase bg-accent border-3 border-black shadow-brutal hover:shadow-brutal-lg hover:-translate-y-0.5 transition-all">
                        ⬇ Download Card
                    </button>
                </div>
            </div>

            {{-- Save Modal (mobile) --}}
            <div id="save-modal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.88);z-index:9999;align-items:center;justify-content:center;padding:16px;">
                <div class="bg-surface border-3 border-black shadow-brutal p-4 w-full max-w-sm mx-auto">
                    <h3 class="text-base font-extrabold uppercase mb-1 text-black">Simpan Kartu</h3>
                    <p class="text-[11px] font-bold text-black/60 uppercase mb-3">Tekan lama gambar → Save Image</p>
                    <div class="border-2 border-black mb-4 overflow-hidden">
                        <img id="save-modal-img" src="" alt="IGX Card" style="width:100%;display:block;">
                    </div>
                    <button onclick="document.getElementById('save-modal').style.display='none'"
                        class="btn-brutal w-full py-2 text-sm font-extrabold uppercase">
                        Tutup
                    </button>
                </div>
            </div>

            {{-- RIGHT: Preview --}}
            <div class="w-full lg:flex-1 flex flex-col items-center">
                <div class="mb-3">
                    <span class="bg-primary border-2 border-black px-4 py-1 text-xs font-extrabold uppercase text-surface shadow-brutal-sm">
                        Preview
                    </span>
                </div>
                <div class="card-brutal overflow-hidden inline-block">
                    <canvas id="card-canvas"
                            style="display:block; width:100%; height:auto; vertical-align:bottom;"
                            width="1260" height="1574">
                    </canvas>
                </div>
                <p class="mt-3 text-[10px] font-bold text-surface/50 uppercase tracking-wider text-center">
                    Aspect Ratio: 4:5 (Original Scale)
                </p>
            </div>
        </div>
    </div>
</div>

{{-- Cropper Modal --}}
<div id="cropper-modal">
    <div class="bg-surface border-3 border-black shadow-brutal p-4 sm:p-6 w-full max-w-lg mx-4">
        <h3 class="text-base font-extrabold uppercase mb-4 text-black">Crop Your Photo</h3>
        <div class="overflow-hidden mb-4" style="max-height:65vh;">
            <img id="crop-image-el" src="" alt="Crop">
        </div>
        <div class="flex gap-3 justify-end">
            <button onclick="cancelCrop()"
                class="btn-brutal px-4 py-2 text-sm font-extrabold uppercase">
                Cancel
            </button>
            <button onclick="confirmCrop()"
                class="btn-brutal px-4 py-2 text-sm font-extrabold uppercase bg-accent border-black">
                ✓ Crop & Apply
            </button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.js"></script>
<script>
// ─── Font Load ────────────────────────────────────────────
const ttFont = new FontFace('TT Rounds Neue', 'url(/fonts/TT Rounds Neue Trial ExtraBold.ttf)');
ttFont.load().then(f => {
    document.fonts.add(f);
    renderCard();
}).catch(() => {});

// ─── State ────────────────────────────────────────────────
let croppedDataUrl = null;
let cropper = null;
const W = 1260, H = 1574;

// Photo area constants (global)
const PX = 250, PY = 400, PW = 760, PH = 942;

// Template images
const imgBg   = new Image();
const imgFg   = new Image();
let bgLoaded  = false;
let fgLoaded  = false;

imgBg.crossOrigin = 'anonymous';
imgFg.crossOrigin = 'anonymous';

imgBg.onload = () => { bgLoaded = true;  renderCard(); };
imgFg.onload = () => { fgLoaded = true;  renderCard(); };

imgBg.src = '{{ asset("media/images/card-maker/Photo Share back.png") }}';
imgFg.src = '{{ asset("media/images/card-maker/Photo Share front.png") }}';

// ─── Char Counter ─────────────────────────────────────────
function updateCount(inputId, countId, max) {
    const el  = document.getElementById(inputId);
    const cnt = document.getElementById(countId);
    const len = el.value.length;
    cnt.textContent = len + '/' + max;
    cnt.classList.toggle('warn', len >= max * 0.85);
}

// ─── Canvas Render ────────────────────────────────────────
function renderCard() {
    const canvas = document.getElementById('card-canvas');
    const ctx    = canvas.getContext('2d');
    const name   = document.getElementById('input-name').value;
    const desc   = document.getElementById('input-desc').value;

    ctx.clearRect(0, 0, W, H);

    // 1. Background
    if (bgLoaded) ctx.drawImage(imgBg, 0, 0, W, H);
    else {
        ctx.fillStyle = '#322366';
        ctx.fillRect(0, 0, W, H);
    }

    // Photo area (scaled from 4117×5146 → 1260×1574, uniform scale 0.306):
    // (817,1308)->(3298,4389) => canvas x=250,y=400,w=760,h=942

    if (croppedDataUrl) {
        const photoImg = new Image();
        photoImg.onload = () => {
            ctx.save();
            ctx.drawImage(photoImg, PX, PY, PW, PH);
            ctx.restore();
            if (fgLoaded) ctx.drawImage(imgFg, 0, 0, W, H);
            drawText(ctx, name, desc);
        };
        photoImg.src = croppedDataUrl;
    } else {
        // Placeholder
        ctx.fillStyle = '#9A94CC';
        ctx.fillRect(PX, PY, PW, PH);
        ctx.fillStyle = '#ffffff66';
        ctx.font = 'bold 30px sans-serif';
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';
        ctx.fillText('Upload your photo', PX + PW/2, PY + PH/2);
        if (fgLoaded) ctx.drawImage(imgFg, 0, 0, W, H);
        drawText(ctx, name, desc);
    }
}

function drawText(ctx, name, desc) {
    // ── Name ──────────────────────────────────────────────
    // Original: right x=503 → ×2 = 1006; y=187 → ×2 = 374
    // Font size dinamis nama: 68..36px (untuk max 20 chars)
    if (name) {
        const len = name.length;
        const size = Math.round(68 - (len - 1) * (32 / 19)); // 68..36px
        ctx.save();
        ctx.font = `800 ${size}px "TT Rounds Neue", Arial, sans-serif`;
        ctx.fillStyle = '#4750d0';
        ctx.textAlign = 'right';
        ctx.textBaseline = 'middle';
        ctx.fillText(name.toUpperCase(), 1006, 374);
        ctx.restore();
    }

    // ── Description ───────────────────────────────────────
    // Desc box canvas: x=314, y=1056, w=632, h=142 → pad 16px inside
    if (desc) {
        ctx.save();
        ctx.font = '800 22px "TT Rounds Neue", Arial, sans-serif';
        ctx.fillStyle = '#ffffff';
        ctx.textAlign = 'left';
        ctx.textBaseline = 'top';
        wrapText(ctx, desc, 330, 1072, 600, 32, 4);
        ctx.restore();
    }
}

function wrapText(ctx, text, x, y, maxWidth, lineHeight, maxLines) {
    const words = text.split(' ');
    let line = '';
    let currentY = y;
    let lineCount = 0;

    for (let i = 0; i < words.length; i++) {
        const testLine = line + words[i] + ' ';
        const metrics  = ctx.measureText(testLine);
        if (metrics.width > maxWidth && i > 0) {
            ctx.fillText(line.trimEnd(), x, currentY);
            line      = words[i] + ' ';
            currentY += lineHeight;
            lineCount++;
            if (lineCount >= maxLines) {
                // last line with ellipsis
                let last = line.trimEnd();
                while (ctx.measureText(last + '…').width > maxWidth && last.length > 0) {
                    last = last.slice(0, -1);
                }
                ctx.fillText(last + '…', x, currentY);
                return;
            }
        } else {
            line = testLine;
        }
    }
    ctx.fillText(line.trimEnd(), x, currentY);
}

// ─── Cropper ──────────────────────────────────────────────
document.getElementById('photo-input').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = (ev) => openCropper(ev.target.result);
    reader.readAsDataURL(file);
    // reset so same file can be re-selected
    this.value = '';
});

function openCropper(src) {
    const modal = document.getElementById('cropper-modal');
    const img   = document.getElementById('crop-image-el');
    img.src     = src;
    modal.classList.add('active');

    if (cropper) { cropper.destroy(); cropper = null; }

    // slight delay so image paints before cropper init
    setTimeout(() => {
        cropper = new Cropper(img, {
            aspectRatio: 380 / 471,
            viewMode: 1,
            autoCropArea: 0.9,
            movable: false,
            zoomable: false,
            rotatable: false,
            scalable: false,
            cropBoxMovable: true,
            cropBoxResizable: true,
            dragMode: 'none',
        });
    }, 100);
}

function cancelCrop() {
    document.getElementById('cropper-modal').classList.remove('active');
    if (cropper) { cropper.destroy(); cropper = null; }
}

function confirmCrop() {
    if (!cropper) return;
    const cropCanvas = cropper.getCroppedCanvas({ width: 1520, height: 1884 });
    croppedDataUrl = cropCanvas.toDataURL('image/png');

    // Update thumb
    document.getElementById('crop-thumb').src = croppedDataUrl;
    document.getElementById('crop-thumb-wrap').classList.remove('hidden');
    document.getElementById('upload-area').classList.add('hidden');

    cancelCrop();
    renderCard();
}

// ─── Download (2× HD) + Submit to server ──────────────────
function downloadCard() {
    const SCALE  = 2;
    const hdW    = W * SCALE;
    const hdH    = H * SCALE;

    const hdCanvas = document.createElement('canvas');
    hdCanvas.width  = hdW;
    hdCanvas.height = hdH;
    const hdCtx = hdCanvas.getContext('2d');
    hdCtx.scale(SCALE, SCALE);

    const name = document.getElementById('input-name').value;
    const desc = document.getElementById('input-desc').value;

    // 1. Background
    if (bgLoaded) hdCtx.drawImage(imgBg, 0, 0, W, H);
    else {
        hdCtx.fillStyle = '#322366';
        hdCtx.fillRect(0, 0, W, H);
    }

    // 2. Photo
    const drawFgAndText = () => {
        if (fgLoaded) hdCtx.drawImage(imgFg, 0, 0, W, H);
        drawText(hdCtx, name, desc);

        hdCanvas.toBlob((blob) => {
            // ── Trigger browser download ──
            const url     = URL.createObjectURL(blob);
            const nameVal = document.getElementById('input-name').value.trim();
            const ts      = new Date().toISOString().slice(0,19).replace(/[:T]/g, '-');
            const slug    = nameVal ? nameVal.toLowerCase().replace(/\s+/g, '-').replace(/[^a-z0-9-]/g, '') + '-' : '';
            const link    = document.createElement('a');
            link.href     = url;
            link.download = `igx-card-${slug}${ts}.png`;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            setTimeout(() => URL.revokeObjectURL(url), 5000);

            // ── Submit to server silently (fire-and-forget) ──
            // Downscale 2×→1× + re-encode WebP so the base64 payload stays
            // under nginx client_max_body_size (1MB default → 413 error).
            const gCanvas = document.createElement('canvas');
            gCanvas.width  = W;
            gCanvas.height = H;
            const gCtx = gCanvas.getContext('2d');
            gCtx.imageSmoothingQuality = 'high';
            gCtx.drawImage(hdCanvas, 0, 0, W, H);

            const sendGallery = (quality) => {
                gCanvas.toBlob((gBlob) => {
                    if (!gBlob) return;
                    // Still too big? Re-encode at lower quality.
                    if (gBlob.size > 700 * 1024 && quality > 0.4) {
                        return sendGallery(quality - 0.2);
                    }
                    const reader = new FileReader();
                    reader.onload = () => {
                        fetch(window.location.origin + '/card-maker/submit', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': (document.querySelector('meta[name="csrf-token"]') || {}).content,
                            },
                            body: JSON.stringify({
                                name:  document.getElementById('input-name').value.trim(),
                                description: document.getElementById('input-desc').value.trim(),
                                image: reader.result,
                            }),
                        }).catch(() => {}); // silent — never alert user on failure
                    };
                    reader.readAsDataURL(gBlob);
                }, 'image/webp', quality);
            };
            sendGallery(0.8);
        }, 'image/png');
    };

    if (croppedDataUrl) {
        const photoImg  = new Image();
        photoImg.onload = () => {
            hdCtx.drawImage(photoImg, PX, PY, PW, PH);
            drawFgAndText();
        };
        photoImg.src = croppedDataUrl;
    } else {
        hdCtx.fillStyle = '#9A94CC';
        hdCtx.fillRect(PX, PY, PW, PH);
        hdCtx.fillStyle = '#ffffff66';
        hdCtx.font = 'bold 30px sans-serif';
        hdCtx.textAlign = 'center';
        hdCtx.textBaseline = 'middle';
        hdCtx.fillText('Upload your photo', PX + PW/2, PY + PH/2);
        drawFgAndText();
    }
}

// Initial render
renderCard();
</script>
@endpush
