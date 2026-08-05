@extends('layouts.ticket', ['title' => 'Checkout Tiket'])

@section('content')
<section class="relative">
    <div class="container mx-auto px-5 xl:px-12 py-14 sm:py-20 max-w-3xl">
        <div class="text-center mb-10">
            <h1 class="text-2xl sm:text-4xl font-extrabold uppercase text-white">Checkout</h1>
            <p class="text-sm font-bold text-white/60 mt-2">Isi data dirimu dan selesaikan pembayaran via Midtrans.</p>
        </div>

        @if ($errors->any())
            <div class="rounded-2xl border-2 border-crimson bg-crimson/15 p-5 mb-8">
                <p class="font-extrabold uppercase text-white mb-2">Periksa kembali:</p>
                <ul class="list-disc list-inside text-sm font-bold text-white/70 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('ticket.checkout.store') }}" class="bg-info-dark rounded-2xl border-2 border-white/10 p-6 sm:p-10 space-y-8">
            @csrf

            <div>
                <h2 class="font-extrabold uppercase text-white mb-4 text-sm tracking-wider">1. Pilih Tiket</h2>
                @foreach ($ticketTypes as $index => $type)
                    @if ($type->isSoldOut()) @continue @endif
                    <label class="flex items-center justify-between gap-4 rounded-xl border-2 border-white/10 bg-secondary/60 px-4 py-3 mb-3 cursor-pointer transition-all hover:border-accent/60 {{ old('items.0.ticket_type_id') == $type->id || ($selected && $selected->id === $type->id) ? 'ring-2 ring-accent border-accent' : '' }}">
                        <span class="flex items-center gap-3">
                            <input type="radio" name="items[0][ticket_type_id]" value="{{ $type->id }}"
                                   class="w-4 h-4 accent-accent"
                                   @checked(old('items.0.ticket_type_id') == $type->id || ($selected && $selected->id === $type->id))>
                            <span>
                                <span class="font-extrabold uppercase text-white block">{{ $type->name }}</span>
                                @if ($type->description)
                                    <span class="text-xs font-bold text-white/50">{{ $type->description }}</span>
                                @endif
                            </span>
                        </span>
                        <span class="font-extrabold text-accent shrink-0">IDR {{ number_format($type->price, 0, ',', '.') }}</span>
                    </label>
                @endforeach
                @error('items.0.ticket_type_id')
                    <p class="text-xs font-extrabold uppercase text-crimson mt-1">{{ $message }}</p>
                @enderror

                <div class="mt-4 flex items-center gap-3">
                    <label for="qty" class="font-extrabold uppercase text-white text-sm">Jumlah</label>
                    <input type="number" name="items[0][qty]" id="qty" min="1" max="10" value="{{ old('items.0.qty', 1) }}"
                           class="rounded-xl border-2 border-white/10 bg-secondary/60 px-4 py-2 w-24 font-extrabold text-center text-white">
                    @error('items.0.qty')
                        <p class="text-xs font-extrabold uppercase text-crimson">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <h2 class="font-extrabold uppercase text-white mb-4 text-sm tracking-wider">2. Data Diri</h2>
                <div class="grid gap-4">
                    <div>
                        <label for="customer_name" class="font-extrabold uppercase text-white text-xs mb-1 block">Nama Lengkap *</label>
                        <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name') }}"
                               class="w-full rounded-xl border-2 border-white/10 bg-secondary/60 px-4 py-3 font-bold text-white" required>
                        @error('customer_name')<p class="text-xs font-extrabold uppercase text-crimson mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="customer_email" class="font-extrabold uppercase text-white text-xs mb-1 block">Email *</label>
                        <input type="email" name="customer_email" id="customer_email" value="{{ old('customer_email') }}"
                               class="w-full rounded-xl border-2 border-white/10 bg-secondary/60 px-4 py-3 font-bold text-white" required>
                        @error('customer_email')<p class="text-xs font-extrabold uppercase text-crimson mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="customer_phone" class="font-extrabold uppercase text-white text-xs mb-1 block">No. WhatsApp</label>
                        <input type="tel" name="customer_phone" id="customer_phone" value="{{ old('customer_phone') }}"
                               class="w-full rounded-xl border-2 border-white/10 bg-secondary/60 px-4 py-3 font-bold text-white">
                    </div>
                </div>
            </div>

            <div class="rounded-xl border-2 border-accent/40 bg-accent/10 px-5 py-4 flex items-center gap-4">
                <span class="w-10 h-10 shrink-0 rounded-xl bg-accent/25 flex items-center justify-center">
                    <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"/></svg>
                </span>
                <p class="text-xs sm:text-sm font-bold text-white/70">
                    Pembayaran diproses via <strong class="text-white">Midtrans</strong> — Virtual Account, QRIS &amp; E-Wallet. Integrasi segera hadir.
                </p>
            </div>

            <button type="submit" class="w-full bg-gradient-to-r from-accent to-[#C9338F] text-white font-extrabold uppercase text-sm tracking-wider rounded-full px-6 py-4 transition-all duration-150 hover:brightness-110 hover:-translate-y-0.5">
                Buat Order
            </button>
        </form>
    </div>
</section>
@endsection
