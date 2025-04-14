@section('style')
<style>
    body {
        background-color: var(--color-primary) !important;
    }
</style>
@endsection

@extends('layouts.secondary', [
    'title' => 'Coming Soon',
])
@section('content')
<main class="flex h-screen text-center items-center justify-center bg-primary text-white relative overflow-hidden">
    <img src="{{ asset('media/images/illustrations/banner.webp') }}" class="w-full opacity-5" alt="">
    <div class="absolute">
        <div class="container mx-auto px-12 pt-32">
            <h1 class="font-extrabold text-9xl tracking-[-1rem] -mt-[6.2rem]">
                WE ARE
            </h1>
            <h1 class="font-extrabold text-9xl tracking-[-1rem] -mt-[2.5rem]">
                COMING
            </h1>
            <h1 class="font-extrabold text-[10rem] tracking-[-1rem] -mt-[5rem]">
                SOON
            </h1>
            <h1 class="font-extrabold text-[14rem] tracking-[-1.5rem] -mt-[10rem]">
                2025
            </h1>
        </div>
    </div>
</main>
@endsection