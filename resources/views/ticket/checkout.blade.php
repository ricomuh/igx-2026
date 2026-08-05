@extends('layouts.main', ['title' => 'Checkout Tiket'])

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

        <form method="POST" action="{{ route('ticket.checkout.store') }}" class="card-brutal bg-surface p-6 sm:p-10 space-y-8">
            @csrf

            <div>
                <h2 class="font-extrabold uppercase text-black mb-4 text-sm tracking-wider">1. Pilih Tiket</h2>
                @foreach ($ticketTypes as $index => $type)
                    @if ($type->isSoldOut()) @continue @endif
                    <label class="flex items-center justify-between gap-4 border-3 border-black bg-bg px-4 py-3 mb-3 cursor-pointer transition-all hover:bg-secondary/40 {{ old('items.0.ticket_type_id') == $type->id || ($selected && $selected->id === $type->id) ? 'ring-4 ring-highlight' : '' }}">
                        <span class="flex items-center gap-3">
                            <input type="radio" name="items[0][ticket_type_id]" value="{{ $type->id }}"
                                   class="w-4 h-4 accent-black"
                                   @checked(old('items.0.ticket_type_id') == $type->id || ($selected && $selected->id === $type->id))>
                            <span>
                                <span class="font-extrabold uppercase text-black block">{{ $type->name }}</span>
                                @if ($type->description)
                                    <span class="text-xs font-bold text-black/50">{{ $type->description }}</span>
                                @endif
                            </span>
                        </span>
                        <span class="font-extrabold text-highlight shrink-0">Rp {{ number_format($type->price, 0, ',', '.') }}</span>
                    </label>
                @endforeach
                @error('items.0.ticket_type_id')
                    <p class="text-xs font-extrabold uppercase text-crimson mt-1">{{ $message }}</p>
                @enderror

                <div class="mt-4 flex items-center gap-3">
                    <label for="qty" class="font-extrabold uppercase text-black text-sm">Jumlah</label>
                    <input type="number" name="items[0][qty]" id="qty" min="1" max="10" value="{{ old('items.0.qty', 1) }}"
                           class="border-3 border-black bg-bg px-4 py-2 w-24 font-extrabold text-center">
                    @error('items.0.qty')
                        <p class="text-xs font-extrabold uppercase text-crimson">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <h2 class="font-extrabold uppercase text-black mb-4 text-sm tracking-wider">2. Data Diri</h2>
                <div class="grid gap-4">
                    <div>
                        <label for="customer_name" class="font-extrabold uppercase text-black text-xs mb-1 block">Nama Lengkap *</label>
                        <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name') }}"
                               class="w-full border-3 border-black bg-bg px-4 py-3 font-bold" required>
                        @error('customer_name')<p class="text-xs font-extrabold uppercase text-crimson mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="customer_email" class="font-extrabold uppercase text-black text-xs mb-1 block">Email *</label>
                        <input type="email" name="customer_email" id="customer_email" value="{{ old('customer_email') }}"
                               class="w-full border-3 border-black bg-bg px-4 py-3 font-bold" required>
                        @error('customer_email')<p class="text-xs font-extrabold uppercase text-crimson mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="customer_phone" class="font-extrabold uppercase text-black text-xs mb-1 block">No. WhatsApp</label>
                        <input type="tel" name="customer_phone" id="customer_phone" value="{{ old('customer_phone') }}"
                               class="w-full border-3 border-black bg-bg px-4 py-3 font-bold">
                    </div>
                </div>
            </div>

            <button type="submit" class="w-full bg-highlight border-3 border-black px-6 py-4 font-extrabold uppercase text-black shadow-brutal hover:shadow-brutal-lg hover:-translate-y-0.5 transition-all">
                Buat Order
            </button>
        </form>
    </div>
</section>
@endsection
