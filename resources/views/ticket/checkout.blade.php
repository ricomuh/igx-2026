@extends('layouts.ticket', ['title' => 'Checkout Tiket'])

@section('content')
<section class="bg-bg border-b-4 border-black">
    <div class="container mx-auto px-5 xl:px-12 py-20 xl:py-24 max-w-3xl">
        <div class="flex items-center gap-4 mb-10">
            <div class="bg-highlight border-3 border-black px-4 py-2 shadow-brutal-sm rotate-[-1deg]">
                <h1 class="text-lg sm:text-xl lg:text-2xl font-extrabold uppercase text-black tracking-wider">Checkout</h1>
            </div>
            <div class="h-0.5 flex-1 bg-black/10"></div>
        </div>

        @if ($errors->any())
            <div class="card-brutal bg-crimson/10 border-crimson p-5 mb-8">
                <p class="font-extrabold uppercase text-crimson mb-2">Periksa kembali:</p>
                <ul class="list-disc list-inside text-sm font-bold text-black/70 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Empty cart state --}}
        <div class="card-brutal bg-surface p-10 text-center mb-8" x-show="!cart.length">
            <p class="font-extrabold uppercase text-lg text-black">Keranjang Belanja Kosong</p>
            <p class="text-sm font-bold text-black/50 mt-2 mb-6">Tambahkan tiket dulu sebelum checkout.</p>
            <a href="{{ route('ticket.landing') }}"
               class="inline-block bg-accent border-3 border-black px-6 py-3 font-extrabold uppercase text-black shadow-brutal-sm hover:bg-highlight transition-colors">
                &larr; Pilih Tiket
            </a>
        </div>

        <form method="POST" action="{{ route('ticket.checkout.store') }}" class="card-brutal bg-surface p-6 sm:p-10 space-y-8" x-show="cart.length">
            @csrf

            {{-- Hidden items rendered from cart (Alpine) --}}
            <template x-for="(item, index) in cart" :key="item.ticket_type_id">
                <div class="hidden">
                    <input type="hidden" :name="`items[${index}][ticket_type_id]`" :value="item.ticket_type_id">
                    <input type="hidden" :name="`items[${index}][qty]`" :value="item.qty">
                </div>
            </template>

            {{-- 1. Order Summary --}}
            <div>
                <h2 class="font-extrabold uppercase text-black mb-4 text-sm tracking-wider">1. Order Summary</h2>
                <div class="space-y-3 mb-4">
                    <template x-for="(item, index) in cart" :key="item.ticket_type_id">
                        <div class="flex items-center gap-3 border-3 border-black bg-bg px-4 py-3">
                            <div class="flex-1 min-w-0">
                                <span class="font-extrabold uppercase text-black block text-sm" x-text="item.name"></span>
                                <span class="text-xs font-bold text-black/50" x-text="formatRupiah(item.price) + ' / tiket'"></span>
                            </div>
                            <div class="flex items-center gap-2">
                                <button type="button" @click="updateQty(item.ticket_type_id, item.qty - 1)"
                                        class="bg-surface border-2 border-black w-7 h-7 flex items-center justify-center font-extrabold hover:bg-black/5">-</button>
                                <span class="w-8 text-center font-extrabold text-black" x-text="item.qty"></span>
                                <button type="button" @click="updateQty(item.ticket_type_id, item.qty + 1)"
                                        class="bg-surface border-2 border-black w-7 h-7 flex items-center justify-center font-extrabold hover:bg-black/5">+</button>
                            </div>
                            <span class="font-extrabold text-black text-sm w-24 text-right" x-text="formatRupiah(item.price * item.qty)"></span>
                        </div>
                    </template>
                </div>
                <div class="bg-highlight border-3 border-black px-4 py-3 shadow-brutal-sm flex items-center justify-between">
                    <span class="font-extrabold uppercase text-black text-sm">Total</span>
                    <span class="font-extrabold text-black text-lg" x-text="formatRupiah(cartTotal)"></span>
                </div>
            </div>

            {{-- 2. Personal Details --}}
            <div>
                <h2 class="font-extrabold uppercase text-black mb-4 text-sm tracking-wider">2. Personal Details</h2>
                <div class="grid gap-4">
                    <div>
                        <label for="customer_name" class="font-extrabold uppercase text-black text-xs mb-1 block">Name *</label>
                        <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name') }}"
                               class="w-full border-3 border-black bg-bg px-4 py-3 font-bold" required placeholder="Your full name">
                        @error('customer_name')<p class="text-xs font-extrabold uppercase text-crimson mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label for="age" class="font-extrabold uppercase text-black text-xs mb-1 block">Age *</label>
                            <input type="number" name="age" id="age" min="1" max="120" value="{{ old('age') }}"
                                   class="w-full border-3 border-black bg-bg px-4 py-3 font-bold" required placeholder="e.g. 22">
                            @error('age')<p class="text-xs font-extrabold uppercase text-crimson mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="gender" class="font-extrabold uppercase text-black text-xs mb-1 block">Gender *</label>
                            <select name="gender" id="gender" required
                                    class="w-full border-3 border-black bg-bg px-4 py-3 font-bold">
                                <option value="" disabled @selected(! old('gender'))>Select gender</option>
                                @foreach (['Male', 'Female', 'Other', 'Prefer not to say'] as $option)
                                    <option value="{{ $option }}" @selected(old('gender') === $option)>{{ $option }}</option>
                                @endforeach
                            </select>
                            @error('gender')<p class="text-xs font-extrabold uppercase text-crimson mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <div>
                        <label for="nationality" class="font-extrabold uppercase text-black text-xs mb-1 block">Nationality *</label>
                        <input type="text" name="nationality" id="nationality" value="{{ old('nationality') }}"
                               class="w-full border-3 border-black bg-bg px-4 py-3 font-bold" required placeholder="e.g. Indonesian">
                        @error('nationality')<p class="text-xs font-extrabold uppercase text-crimson mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="customer_email" class="font-extrabold uppercase text-black text-xs mb-1 block">Email *</label>
                        <input type="email" name="customer_email" id="customer_email" value="{{ old('customer_email') }}"
                               class="w-full border-3 border-black bg-bg px-4 py-3 font-bold" required placeholder="you@example.com">
                        @error('customer_email')<p class="text-xs font-extrabold uppercase text-crimson mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="customer_phone" class="font-extrabold uppercase text-black text-xs mb-1 block">Phone Number *</label>
                        <input type="tel" name="customer_phone" id="customer_phone" value="{{ old('customer_phone') }}"
                               class="w-full border-3 border-black bg-bg px-4 py-3 font-bold" required placeholder="+62 812 3456 7890">
                        @error('customer_phone')<p class="text-xs font-extrabold uppercase text-crimson mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            {{-- 3. Organizer --}}
            <div>
                <h2 class="font-extrabold uppercase text-black mb-4 text-sm tracking-wider">3. Organizer</h2>
                <div class="border-3 border-black bg-bg px-5 py-4 space-y-1">
                    <p class="font-extrabold uppercase text-black text-sm">PT Daya Kreasi Asasta</p>
                    <p class="text-xs font-bold text-black/60 leading-relaxed">
                        MyRepublic Plaza, Wing A, Lt. Dasar, Zona 6<br>
                        Jl. Grand Boulevard, BSD Green Office Park, BSD City<br>
                        Sampora, Cisauk, Kab. Tangerang, Banten 15345
                    </p>
                </div>
            </div>

            <div class="bg-cyan/10 border-3 border-black px-5 py-4 flex items-center gap-4">
                <span class="w-10 h-10 shrink-0 bg-cyan border-2 border-black flex items-center justify-center">
                    <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"/></svg>
                </span>
                <p class="text-xs sm:text-sm font-bold text-black/70">
                    Payment is processed via <strong class="text-black">Midtrans</strong> — Virtual Account, QRIS &amp; E-Wallet. Integration coming soon.
                </p>
            </div>

            <button type="submit" class="w-full bg-accent border-3 border-black px-6 py-4 font-extrabold uppercase text-black shadow-brutal hover:shadow-brutal-lg hover:-translate-y-0.5 transition-all">
                Place Order &rarr;
            </button>
        </form>
    </div>
</section>
@endsection
