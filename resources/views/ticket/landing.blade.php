@extends('layouts.main', ['title' => 'Tiket'])

@section('content')
{{-- ===== TICKET HERO ===== --}}
<section class="bg-secondary border-b-4 border-black relative overflow-hidden">
    <div class="container mx-auto px-5 xl:px-12 py-20 xl:py-28 text-center">
        <div class="bg-black border-2 border-cyan px-4 py-2 shadow-brutal-sm rotate-[-1deg] inline-block mb-6">
            <h1 class="text-lg sm:text-xl lg:text-2xl font-extrabold uppercase text-cyan tracking-wider">
                Indonesia Game Expo 2026
            </h1>
        </div>
        <h2 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold uppercase text-surface mb-4 drop-shadow-brutal">
            Beli Tiket Sekarang
        </h2>
        <p class="text-surface/70 font-bold max-w-2xl mx-auto">
            Akses penuh ke pameran, kompetisi, dan pengalaman gaming paling seru di Indonesia.
            Pilih tiket, transfer, upload bukti — selesai.
        </p>
    </div>
</section>

{{-- ===== TICKET TYPES ===== --}}
<section class="bg-bg border-b-4 border-black">
    <div class="container mx-auto px-5 xl:px-12 py-20 xl:py-28">
        <div class="flex items-center gap-4 mb-12">
            <div class="bg-highlight border-3 border-black px-4 py-2 shadow-brutal-sm rotate-[-1deg]">
                <h2 class="text-lg sm:text-xl lg:text-2xl font-extrabold uppercase text-black tracking-wider">
                    Pilih Tiket
                </h2>
            </div>
            <div class="h-0.5 flex-1 bg-black/10"></div>
        </div>

        @if ($ticketTypes->isEmpty())
            <div class="card-brutal bg-surface p-10 text-center">
                <p class="font-extrabold uppercase text-lg">Tiket belum dibuka</p>
                <p class="text-sm font-bold text-black/50 mt-2">Pantau terus website ini ya!</p>
            </div>
        @else
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                @foreach ($ticketTypes as $type)
                    <div class="card-brutal bg-surface p-6 sm:p-8 flex flex-col transition-all duration-200 hover:shadow-brutal-lg hover:-translate-y-1">
                        <div class="flex items-start justify-between mb-4">
                            <h3 class="text-xl font-extrabold uppercase text-black">{{ $type->name }}</h3>
                            @if ($type->isSoldOut())
                                <span class="bg-crimson text-white text-[10px] font-extrabold uppercase px-2 py-1 border-2 border-black">Habis</span>
                            @endif
                        </div>
                        @if ($type->description)
                            <p class="text-sm font-bold text-black/60 mb-4">{{ $type->description }}</p>
                        @endif
                        <div class="bg-secondary border-3 border-black px-4 py-3 shadow-brutal-sm mb-4">
                            <span class="text-2xl sm:text-3xl font-extrabold text-highlight">Rp {{ number_format($type->price, 0, ',', '.') }}</span>
                        </div>
                        @if ($type->capacity)
                            <p class="text-[10px] font-bold uppercase text-black/40 mb-4">
                                Kuota {{ $type->soldCount() }}/{{ $type->capacity }} terjual
                            </p>
                        @endif
                        <div class="mt-auto">
                            @if ($type->isSoldOut())
                                <div class="bg-black/5 border-3 border-black/30 px-4 py-3 text-center font-extrabold uppercase text-black/30">Sold Out</div>
                            @else
                                <a href="{{ route('ticket.checkout', ['type' => $type->slug]) }}"
                                   class="block bg-highlight border-3 border-black px-4 py-3 text-center font-extrabold uppercase text-black shadow-brutal-sm hover:shadow-brutal hover:-translate-y-0.5 transition-all">
                                    Beli Sekarang
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

{{-- ===== HOW TO BUY ===== --}}
<section class="bg-surface border-b-4 border-black">
    <div class="container mx-auto px-5 xl:px-12 py-20 xl:py-24">
        <div class="flex items-center gap-4 mb-12">
            <div class="bg-cyan border-3 border-black px-4 py-2 shadow-brutal-sm rotate-[0.5deg]">
                <h2 class="text-lg sm:text-xl lg:text-2xl font-extrabold uppercase text-black tracking-wider">Cara Beli</h2>
            </div>
            <div class="h-0.5 flex-1 bg-black/10"></div>
        </div>
        <div class="grid sm:grid-cols-3 gap-6">
            @foreach ([
                '1' => ['Pilih Tiket', 'Tentukan jenis tiket dan jumlah yang kamu mau.'],
                '2' => ['Transfer ke Rekening', 'Transfer total sesuai instruksi di halaman pembayaran.'],
                '3' => ['Upload Bukti', 'Upload bukti transfer, admin verifikasi, tiket aktif.'],
            ] as $step => [$title, $desc])
                <div class="card-brutal bg-bg p-6">
                    <div class="w-10 h-10 bg-highlight border-3 border-black flex items-center justify-center font-extrabold text-black mb-4 shadow-brutal-sm">{{ $step }}</div>
                    <h3 class="font-extrabold uppercase text-black mb-2">{{ $title }}</h3>
                    <p class="text-sm font-bold text-black/60">{{ $desc }}</p>
                </div>
            @endforeach
        </div>
        <div class="mt-12 text-center">
            <a href="{{ route('ticket.status') }}" class="inline-flex items-center gap-2 text-sm font-extrabold uppercase text-primary-dark hover:text-accent transition-colors">
                Cek Status Order
                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
            </a>
        </div>
    </div>
</section>
@endsection
