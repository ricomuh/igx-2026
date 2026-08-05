@extends('layouts.ticket', ['title' => 'Pembayaran Order'])

@php
    $badges = [
        'pending' => ['Menunggu Pembayaran', 'bg-highlight text-black'],
        'confirmed' => ['Pembayaran Dikonfirmasi', 'bg-accent text-white'],
        'cancelled' => ['Dibatalkan', 'bg-crimson text-white'],
    ];
    [$statusLabel, $statusClass] = $badges[$order->status] ?? ['Unknown', 'bg-black text-white'];
@endphp

@section('content')
<section class="relative">
    <div class="container mx-auto px-5 xl:px-12 py-14 sm:py-20 max-w-3xl">
        @if (session('success'))
            <div class="rounded-2xl border-2 border-accent bg-accent/15 p-5 mb-8">
                <p class="font-extrabold uppercase text-white">{{ session('success') }}</p>
            </div>
        @endif
        @if (session('error'))
            <div class="rounded-2xl border-2 border-crimson bg-crimson/15 p-5 mb-8">
                <p class="font-extrabold uppercase text-white">{{ session('error') }}</p>
            </div>
        @endif

        <div class="flex flex-wrap items-center gap-3 mb-10">
            <h1 class="text-2xl sm:text-3xl font-extrabold uppercase text-white">Pembayaran</h1>
            <span class="rounded-full border-2 border-black/30 px-4 py-1.5 text-xs font-extrabold uppercase shadow-sm {{ $statusClass }}">{{ $statusLabel }}</span>
        </div>

        <div class="bg-info-dark rounded-2xl border-2 border-white/10 p-6 sm:p-10 mb-8">
            <div class="grid sm:grid-cols-2 gap-4 mb-6">
                <div>
                    <p class="text-xs font-extrabold uppercase text-white/40 mb-1">Nomor Order</p>
                    <p class="font-extrabold text-white text-lg">{{ $order->order_number }}</p>
                </div>
                <div>
                    <p class="text-xs font-extrabold uppercase text-white/40 mb-1">Nama</p>
                    <p class="font-extrabold text-white">{{ $order->customer_name }}</p>
                </div>
                <div>
                    <p class="text-xs font-extrabold uppercase text-white/40 mb-1">Email</p>
                    <p class="font-bold text-white/70">{{ $order->customer_email }}</p>
                </div>
                <div>
                    <p class="text-xs font-extrabold uppercase text-white/40 mb-1">Tanggal Order</p>
                    <p class="font-bold text-white/70">{{ $order->created_at->timezone('Asia/Jakarta')->translatedFormat('d F Y H:i') }}</p>
                </div>
            </div>

            <table class="w-full border-2 border-white/10 rounded-xl overflow-hidden">
                <thead>
                    <tr class="bg-black/50 text-white">
                        <th class="text-left px-4 py-2.5 text-xs font-extrabold uppercase">Tiket</th>
                        <th class="text-center px-4 py-2.5 text-xs font-extrabold uppercase">Qty</th>
                        <th class="text-right px-4 py-2.5 text-xs font-extrabold uppercase">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="bg-secondary/40">
                    @foreach ($order->items as $item)
                        <tr class="border-t border-white/10">
                            <td class="px-4 py-3 font-extrabold text-white">{{ $item->ticket_name }}</td>
                            <td class="px-4 py-3 text-center font-bold text-white/70">{{ $item->qty }}</td>
                            <td class="px-4 py-3 text-right font-extrabold text-white">IDR {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    <tr class="border-t border-white/10 bg-accent/15">
                        <td colspan="2" class="px-4 py-3 font-extrabold uppercase text-white">Total</td>
                        <td class="px-4 py-3 text-right font-extrabold text-white text-lg">IDR {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        @if ($order->status === 'pending')
            <div class="bg-info-dark rounded-2xl border-2 border-white/10 p-6 sm:p-10 mb-8 text-center">
                <div class="w-16 h-16 mx-auto rounded-2xl bg-accent/20 flex items-center justify-center mb-5">
                    <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"/></svg>
                </div>
                <h2 class="font-extrabold uppercase text-white text-xl mb-2">Pembayaran via Midtrans</h2>
                <p class="text-sm font-bold text-white/55 mb-6 max-w-md mx-auto leading-relaxed">
                    Order kamu tersimpan. Kamu akan diarahkan ke Midtrans untuk menyelesaikan pembayaran — integrasi segera hadir.
                </p>
                <div class="inline-block bg-white/5 border-2 border-white/15 text-white/40 font-extrabold uppercase text-sm rounded-full px-10 py-3.5 cursor-not-allowed">
                    Bayar Sekarang — Segera
                </div>
            </div>
        @elseif ($order->status === 'confirmed')
            <div class="bg-accent rounded-2xl border-2 border-black/30 p-6 sm:p-10 mb-8 text-center">
                <p class="font-extrabold uppercase text-white text-lg">Tiket Aktif!</p>
                <p class="text-sm font-bold text-white/70 mt-2">Pembayaran dikonfirmasi {{ $order->paid_at?->timezone('Asia/Jakarta')->translatedFormat('d F Y H:i') }}. Sampai jumpa di IGX 2026!</p>
            </div>
        @elseif ($order->status === 'cancelled')
            <div class="bg-crimson rounded-2xl border-2 border-black/30 p-6 sm:p-10 mb-8 text-center">
                <p class="font-extrabold uppercase text-white text-lg">Order Dibatalkan</p>
                <p class="text-sm font-bold text-white/70 mt-2">Hubungi panitia untuk informasi lebih lanjut.</p>
            </div>
        @endif

        <p class="text-center">
            <a href="{{ route('ticket.landing') }}" class="inline-flex items-center gap-2 text-sm font-extrabold uppercase text-white/60 hover:text-accent transition-colors">
                &larr; Kembali ke Beranda Tiket
            </a>
        </p>
    </div>
</section>
@endsection
