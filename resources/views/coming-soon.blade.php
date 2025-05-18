@extends('layouts.secondary', [
    'title' => 'Coming Soon',
])
@section('content')
<main class="flex h-screen text-center items-center justify-center bg-primary text-white relative overflow-hidden">
    <img src="{{ asset('media/images/illustrations/banner.webp') }}" class="w-full opacity-5" alt="">
    <div class="absolute scale-50 sm:scale-60 md:scale-70 lg:scale-80 xl:scale-90 2xl:scale-100">
        <div class="container mx-auto px-12">
            <h1 class="font-extrabold text-8xl">
                WE ARE
            </h1>
            <h1 class="font-extrabold text-8xl text-background-footer">
                COMING
            </h1>
            <h1 class="font-extrabold text-9xl leading-none text-background-footer">
                SOON
            </h1>
            <h1 class="font-extrabold text-[11rem] leading-none tracking-[-0.5rem]">
                2025
            </h1>
        </div>
    </div>
</main>
@endsection
