@section('style')
<style>

    /* Animasi untuk teks */
    .coming-soon-title {
        animation: fadeInUp 1.5s ease-in-out forwards;
    }

    .coming-soon-year {
        animation: pulse 2s infinite;
    }

    /* Keyframes untuk animasi */
    @keyframes fadeInUp {
        0% {
            opacity: 0;
            transform: translateY(50px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.1);
        }
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
        <div class="container mx-auto px-12">
            <h1 class="font-extrabold text-[8.5rem] tracking-[-1rem] coming-soon-title">
                WE ARE
            </h1>
            <h1 class="font-extrabold text-9xl text-background-footer tracking-[-1rem] -mt-[4.5rem] coming-soon-title">
                COMING
            </h1>
            <h1 class="font-extrabold text-[11rem] text-background-footer tracking-[-1rem] -mt-[5.625rem] coming-soon-title">
                SOON
            </h1>
            <h1 class="font-extrabold text-[14rem] tracking-[-1.5rem] -mt-[9.5rem] coming-soon-year">
                2025
            </h1>
        </div>
    </div>
</main>
@endsection