@extends('layouts.main', ['title' => 'Contact Us'])

@push('style')
<style>body { background-color: #322366 !important; }</style>
@endpush

@section('content')
<div class="bg-secondary min-h-screen flex items-center justify-center relative overflow-hidden">
    <div class="absolute inset-0 z-0 pointer-events-none opacity-[0.05]"
         style="background-image: radial-gradient(circle, #fff 1px, transparent 1px); background-size: 18px 18px;">
    </div>

    <div class="container mx-auto px-5 py-20 relative z-10">
        <div class="max-w-2xl mx-auto">
            {{-- Header --}}
            <div class="flex justify-center mb-10">
                <div class="bg-primary border-3 border-black shadow-brutal px-8 py-4 rotate-[-1deg]">
                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold uppercase text-black flex items-center gap-3">
                        <x-heroicon-o-phone class="w-7 h-7 sm:w-8 sm:h-8" /> Need Help?
                    </h1>
                </div>
            </div>

            <p class="text-center text-sm sm:text-base font-bold text-surface/60 uppercase mb-10">Contact our support team</p>

            {{-- Contact Cards --}}
            <div class="grid sm:grid-cols-2 gap-5 lg:gap-6">
                <a href="https://api.whatsapp.com/message/U3XML62HR7O2C1" target="_blank" rel="noopener"
                   class="card-brutal bg-accent group hover:shadow-brutal-lg hover:-translate-y-1 transition-all duration-200 p-8 text-center no-underline">
                    <div class="bg-black/20 border-3 border-black w-20 h-20 mx-auto mb-4 flex items-center justify-center group-hover:rotate-6 transition-transform">
                        <img src="{{ asset('/media/images/icons/wa.svg') }}" class="w-10 h-10" alt="WhatsApp">
                    </div>
                    <h2 class="text-xl sm:text-2xl font-extrabold uppercase text-black mb-2">WhatsApp</h2>
                    <p class="text-xs font-bold text-black/60 uppercase">Click to chat</p>
                </a>

                <a href="mailto:indonesiagameexpo23@gmail.com"
                   class="card-brutal bg-highlight group hover:shadow-brutal-lg hover:-translate-y-1 transition-all duration-200 p-8 text-center no-underline">
                    <div class="bg-black/20 border-3 border-black w-20 h-20 mx-auto mb-4 flex items-center justify-center group-hover:rotate-6 transition-transform">
                        <img src="{{ asset('/media/images/icons/email.svg') }}" class="w-10 h-10" alt="Email">
                    </div>
                    <h2 class="text-xl sm:text-2xl font-extrabold uppercase text-black mb-2">E-Mail</h2>
                    <p class="text-xs font-bold text-black/60 uppercase">Send us a message</p>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
