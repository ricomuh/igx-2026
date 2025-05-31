@extends('layouts.main', [
    'title' => 'Contact Us',
])

@push('style')
<style>
    body {
        background-color: var(--color-primary) !important;
    }
</style>
@endpush

@section('content')
<div class="min-h-screen flex items-center justify-center px-5 py-10">
    <div class="grid grid-cols-1 md:grid-cols-2 max-w-5xl w-full items-center">

        {{-- Gambar --}}
        <div class="flex justify-center md:justify-end">
            <img src="{{ asset('media/images/chars/Nitari.webp') }}" class="w-full max-w-56 md:max-w-none" alt="Character illustration - Nitari">
        </div>

        {{-- Konten --}}
        <div class="text-center flex flex-col items-center">
            <h1 class="font-extrabold text-3xl sm:text-4xl lg:text-5xl mb-2 md:mb-4 text-gray-800">Need Help?</h1>
            <p class="mb-6 md:mb-12 text-lg lg:text-xl font-medium text-gray-700">Contact Our Support Team</p>

            <div class="flex flex-col gap-4 w-full max-w-xs">
                <a href="https://api.whatsapp.com/message/U3XML62HR7O2C1" target="_blank"
                   class="btn-primary text-center flex gap-3 justify-center items-center font-extrabold text-lg xl:text-2xl px-6 py-3 rounded-lg">
                   <img src="{{ asset("/media/images/icons/wa.svg") }}" class="size-9" alt="Whatsapp Logo">
                    WhatsApp
                </a>
                <a href="mailto:indonesiagameexpo23@gmail.com"
                   class="btn-primary text-center flex gap-3 justify-center items-center font-extrabold text-lg xl:text-2xl px-6 py-3 rounded-lg">
                   <img src="{{ asset("/media/images/icons/email.svg") }}" class="size-9" alt="Whatsapp Logo">
                    E-Mail
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
