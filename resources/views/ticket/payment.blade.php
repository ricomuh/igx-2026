@extends('layouts.ticket', ['title' => 'Pembayaran Order'])

@php
    $badges = [
        'pending' => ['Awaiting Payment', 'bg-highlight text-black'],
        'waiting_confirmation' => ['Awaiting Admin Verification', 'bg-cyan text-black'],
        'confirmed' => ['Payment Confirmed', 'bg-accent text-white'],
        'cancelled' => ['Cancelled', 'bg-crimson text-white'],
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
                    <p class="text-xs font-extrabold uppercase text-black/40 mb-1">Order Date</p>
                    <p class="font-bold text-black/70">{{ $order->created_at->timezone('Asia/Jakarta')->translatedFormat('d F Y H:i') }}</p>
                </div>
            </div>

            <table class="w-full border-3 border-black">
                <thead>
                    <tr class="bg-black text-white">
                        <th class="text-left px-4 py-2 text-xs font-extrabold uppercase">Ticket</th>
                        <th class="text-center px-4 py-2 text-xs font-extrabold uppercase">Qty</th>
                        <th class="text-right px-4 py-2 text-xs font-extrabold uppercase">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="bg-bg">
                    @foreach ($order->items as $item)
                        <tr class="border-t-3 border-black">
                            <td class="px-4 py-3 font-extrabold text-black">{{ $item->ticket_name }}</td>
                            <td class="px-4 py-3 text-center font-bold text-black/70">{{ $item->qty }}</td>
                            <td class="px-4 py-3 text-right font-extrabold text-black">IDR {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    <tr class="border-t-3 border-black bg-highlight">
                        <td colspan="2" class="px-4 py-3 font-extrabold uppercase text-black">Total</td>
                        <td class="px-4 py-3 text-right font-extrabold text-black text-lg">IDR {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        @if ($order->status === 'pending')
            <div class="card-brutal bg-surface p-6 sm:p-10 mb-8 text-center">
                <div class="w-16 h-16 mx-auto bg-cyan border-3 border-black shadow-brutal-sm flex items-center justify-center mb-5">
                    <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"/></svg>
                </div>
                <h2 class="font-extrabold uppercase text-black text-xl mb-2">Pembayaran via Midtrans</h2>
                <p class="text-sm font-bold text-black/60 mb-6 max-w-md mx-auto">
                    Order kamu tersimpan. Kamu akan diarahkan ke Midtrans untuk menyelesaikan pembayaran — integrasi segera hadir.
                </p>
                <div class="inline-block bg-black/5 border-3 border-black/30 px-10 py-3.5 font-extrabold uppercase text-black/30">
                    Bayar Sekarang — Segera
                </div>
            </div>
        @elseif ($order->status === 'waiting_confirmation')
            <div class="card-brutal bg-cyan p-6 sm:p-10 mb-8 text-center">
                <p class="font-extrabold uppercase text-black text-lg">Bukti sudah kami terima</p>
                <p class="text-sm font-bold text-black/60 mt-2">Tim admin akan memverifikasi pembayaranmu.</p>
            </div>
        @elseif ($order->status === 'confirmed')
            <div class="card-brutal bg-accent p-6 sm:p-10 mb-8 text-center">
                <p class="font-extrabold uppercase text-white text-lg">Ticket Active!</p>
                <p class="text-sm font-bold text-white/70 mt-2">Payment confirmed {{ $order->paid_at?->timezone('Asia/Jakarta')->translatedFormat('d F Y H:i') }}. See you at IGX 2026!</p>
            </div>
        @elseif ($order->status === 'cancelled')
            <div class="card-brutal bg-crimson p-6 sm:p-10 mb-8 text-center">
                <p class="font-extrabold uppercase text-white text-lg">Order Cancelled</p>
                <p class="text-sm font-bold text-white/70 mt-2">Contact the organizer for more information.</p>
            </div>
        @endif

        <p class="text-center">
            <a href="{{ route('ticket.landing') }}" class="inline-flex items-center gap-2 text-sm font-extrabold uppercase text-primary-dark hover:text-accent transition-colors">
                &larr; Back to Tickets
            </a>
        </p>
    </div>
</section>
@endsection
