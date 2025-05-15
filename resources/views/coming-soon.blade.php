@extends('layouts.secondary', [
    'title' => 'Coming Soon',
])
@section('content')
<main class="flex h-screen text-center items-center justify-center bg-primary text-white relative overflow-hidden">
    <img src="{{ asset('media/images/illustrations/banner.webp') }}" class="w-full opacity-5" alt="">
    <div class="absolute scale-40 sm:scale-50 md:scale-60 xl:scale-80 2xl:scale-100">
        <div class="container mx-auto px-12">
            <h1 class="font-extrabold text-[8.5rem] tracking-[-1rem]">
                WE ARE
            </h1>
            <h1 class="font-extrabold text-9xl text-background-footer tracking-[-1rem] -mt-[4.5rem]">
                COMING
            </h1>
            <h1 class="font-extrabold text-[11rem] text-background-footer tracking-[-1rem] -mt-[5.625rem]">
                SOON
            </h1>
            <h1 class="font-extrabold text-[14rem] tracking-[-1.5rem] -mt-[9.5rem]">
                2025
            </h1>
        </div>
    </div>
</main>
@endsection