@extends('layouts.main', ['title' => 'Pembayaran Order'])

@php
    $badges = [
        'pending' => ['Menunggu Pembayaran', 'bg-highlight text-black'],
        'waiting_confirmation' => ['Menunggu Verifikasi Admin', 'bg-cyan text-black'],
        'confirmed' => ['Pembayaran Dikonfirmasi', 'bg-accent text-white'],
        'cancelled' => ['Dibatalkan', 'bg-crimson text-white'],
    ];
    [$statusLabel, $statusClass] = $badges[$order->status] ?? ['Unknown', 'bg-black text-white'];
@endphp

@section('content')
<section class="bg-bg border-b-4 border-black">
    <div class="container mx-auto px-5 xl:px-12 py-20 xl:py-24 max-w-3xl">
        @if (session('success'))
            <div class="card-brutal bg-accent/10 border-accent p-5 mb-8">
                <p class="font-extrabold uppercase text-accent">{{ session('success') }}</p>
            </div>
        @endif
        @if (session('error'))
            <div class="card-brutal bg-crimson/10 border-crimson p-5 mb-8">
                <p class="font-extrabold uppercase text-crimson">{{ session('error') }}</p>
            </div>
        @endif
        @if ($errors->any())
            <div class="card-brutal bg-crimson/10 border-crimson p-5 mb-8">
                <ul class="list-disc list-inside text-sm font-bold text-black/70 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="flex items-center gap-4 mb-10">
            <div class="bg-highlight border-3 border-black px-4 py-2 shadow-brutal-sm rotate-[-1deg]">
                <h1 class="text-lg sm:text-xl lg:text-2xl font-extrabold uppercase text-black tracking-wider">Pembayaran</h1>
            </div>
            <span class="border-3 border-black px-3 py-1.5 text-xs font-extrabold uppercase shadow-brutal-sm {{ $statusClass }}">{{ $statusLabel }}</span>
            <div class="h-0.5 flex-1 bg-black/10"></div>
        </div>

        <div class="card-brutal bg-surface p-6 sm:p-10 mb-8">
            <div class="grid sm:grid-cols-2 gap-4 mb-6">
                <div>
                    <p class="text-xs font-extrabold uppercase text-black/40 mb-1">Nomor Order</p>
                    <p class="font-extrabold text-black text-lg">{{ $order->order_number }}</p>
                </div>
                <div>
                    <p class="text-xs font-extrabold uppercase text-black/40 mb-1">Nama</p>
                    <p class="font-extrabold text-black">{{ $order->customer_name }}</p>
                </div>
                <div>
                    <p class="text-xs font-extrabold uppercase text-black/40 mb-1">Email</p>
                    <p class="font-bold text-black/70">{{ $order->customer_email }}</p>
                </div>
                <div>
                    <p class="text-xs font-extrabold uppercase text-black/40 mb-1">Tanggal Order</p>
                    <p class="font-bold text-black/70">{{ $order->created_at->timezone('Asia/Jakarta')->translatedFormat('d F Y H:i') }}</p>
                </div>
            </div>

            <table class="w-full border-3 border-black">
                <thead>
                    <tr class="bg-black text-white">
                        <th class="text-left px-4 py-2 text-xs font-extrabold uppercase">Tiket</th>
                        <th class="text-center px-4 py-2 text-xs font-extrabold uppercase">Qty</th>
                        <th class="text-right px-4 py-2 text-xs font-extrabold uppercase">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="bg-bg">
                    @foreach ($order->items as $item)
                        <tr class="border-t-3 border-black">
                            <td class="px-4 py-3 font-extrabold text-black">{{ $item->ticket_name }}</td>
                            <td class="px-4 py-3 text-center font-bold text-black/70">{{ $item->qty }}</td>
                            <td class="px-4 py-3 text-right font-extrabold text-black">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    <tr class="border-t-3 border-black bg-highlight">
                        <td colspan="2" class="px-4 py-3 font-extrabold uppercase text-black">Total</td>
                        <td class="px-4 py-3 text-right font-extrabold text-black text-lg">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        @if ($order->status === 'pending')
            <div class="card-brutal bg-surface p-6 sm:p-10 mb-8">
                <h2 class="font-extrabold uppercase text-black mb-4">Instruksi Transfer</h2>
                <div class="bg-secondary border-3 border-black p-5 mb-6">
                    <p class="text-xs font-extrabold uppercase text-black/50 mb-2">Bank BCA</p>
                    <p class="text-2xl font-extrabold text-black tracking-wider">0099 920 205</p>
                    <p class="text-xs font-extrabold uppercase text-black/50 mt-2">a.n. Leolit Games</p>
                </div>
                <ol class="list-decimal list-inside text-sm font-bold text-black/70 space-y-2 mb-6">
                    <li>Transfer <strong class="text-black">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong> ke rekening di atas.</li>
                    <li>Simpan bukti transfer (screenshot/scan).</li>
                    <li>Isi nomor referensi dan upload bukti di bawah.</li>
                </ol>

                <form method="POST" action="{{ route('ticket.payment.upload', $order->order_number) }}" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    <div>
                        <label for="reference_number" class="font-extrabold uppercase text-black text-xs mb-1 block">Nomor Referensi / Kode Transfer *</label>
                        <input type="text" name="reference_number" id="reference_number" value="{{ old('reference_number') }}"
                               class="w-full border-3 border-black bg-bg px-4 py-3 font-bold" required>
                        @error('reference_number')<p class="text-xs font-extrabold uppercase text-crimson mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="proof" class="font-extrabold uppercase text-black text-xs mb-1 block">Upload Bukti Transfer * (JPG/PNG/WebP, maks 2MB)</label>
                        <input type="file" name="proof" id="proof" accept="image/*"
                               class="w-full border-3 border-black bg-bg px-4 py-3 font-bold" required>
                        @error('proof')<p class="text-xs font-extrabold uppercase text-crimson mt-1">{{ $message }}</p>@enderror
                    </div>
                    <button type="submit" class="w-full bg-cyan border-3 border-black px-6 py-4 font-extrabold uppercase text-black shadow-brutal hover:shadow-brutal-lg hover:-translate-y-0.5 transition-all">
                        Upload Bukti Pembayaran
                    </button>
                </form>
            </div>
        @elseif ($order->status === 'waiting_confirmation')
            <div class="card-brutal bg-cyan p-6 sm:p-10 mb-8 text-center">
                <p class="font-extrabold uppercase text-black text-lg">Bukti sudah kami terima</p>
                <p class="text-sm font-bold text-black/60 mt-2">Tim admin akan memverifikasi pembayaranmu. Pantau halaman ini untuk status terbaru.</p>
            </div>
        @elseif ($order->status === 'confirmed')
            <div class="card-brutal bg-accent p-6 sm:p-10 mb-8 text-center">
                <p class="font-extrabold uppercase text-white text-lg">Tiket Aktif!</p>
                <p class="text-sm font-bold text-white/70 mt-2">Pembayaran dikonfirmasi {{ $order->paid_at?->timezone('Asia/Jakarta')->translatedFormat('d F Y H:i') }}. Sampai jumpa di IGX 2026!</p>
            </div>
        @elseif ($order->status === 'cancelled')
            <div class="card-brutal bg-crimson p-6 sm:p-10 mb-8 text-center">
                <p class="font-extrabold uppercase text-white text-lg">Order Dibatalkan</p>
                <p class="text-sm font-bold text-white/70 mt-2">Hubungi panitia untuk informasi lebih lanjut.</p>
            </div>
        @endif

        <p class="text-center">
            <a href="{{ route('ticket.landing') }}" class="inline-flex items-center gap-2 text-sm font-extrabold uppercase text-primary-dark hover:text-accent transition-colors">
                &larr; Kembali ke Beranda Tiket
            </a>
        </p>
    </div>
</section>
@endsection
