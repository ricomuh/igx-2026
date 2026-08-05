@extends('layouts.main', ['title' => 'Cek Status Tiket'])

@section('content')
<section class="bg-bg border-b-4 border-black">
    <div class="container mx-auto px-5 xl:px-12 py-20 xl:py-24 max-w-xl">
        <div class="flex items-center gap-4 mb-10">
            <div class="bg-highlight border-3 border-black px-4 py-2 shadow-brutal-sm rotate-[-1deg]">
                <h1 class="text-lg sm:text-xl lg:text-2xl font-extrabold uppercase text-black tracking-wider">Cek Status Order</h1>
            </div>
            <div class="h-0.5 flex-1 bg-black/10"></div>
        </div>

        @if ($errors->any())
            <div class="card-brutal bg-crimson/10 border-crimson p-5 mb-8">
                <ul class="list-disc list-inside text-sm font-bold text-black/70 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('ticket.status.lookup') }}" class="card-brutal bg-surface p-6 sm:p-10 space-y-5">
            @csrf
            <div>
                <label for="order_number" class="font-extrabold uppercase text-black text-xs mb-1 block">Nomor Order *</label>
                <input type="text" name="order_number" id="order_number" value="{{ old('order_number') }}"
                       class="w-full border-3 border-black bg-bg px-4 py-3 font-bold uppercase" placeholder="IGX-20260804-XXXXXX" required>
                @error('order_number')<p class="text-xs font-extrabold uppercase text-crimson mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="customer_email" class="font-extrabold uppercase text-black text-xs mb-1 block">Email Saat Order *</label>
                <input type="email" name="customer_email" id="customer_email" value="{{ old('customer_email') }}"
                       class="w-full border-3 border-black bg-bg px-4 py-3 font-bold" required>
                @error('customer_email')<p class="text-xs font-extrabold uppercase text-crimson mt-1">{{ $message }}</p>@enderror
            </div>
            <button type="submit" class="w-full bg-highlight border-3 border-black px-6 py-4 font-extrabold uppercase text-black shadow-brutal hover:shadow-brutal-lg hover:-translate-y-0.5 transition-all">
                Cek Status
            </button>
        </form>
    </div>
</section>
@endsection
