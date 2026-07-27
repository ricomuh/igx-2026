@extends('layouts.main', ['title' => 'Terms of Service'])

@push('style')
<style>body { background-color: #322366 !important; }</style>
@endpush

@section('content')
<div class="bg-secondary min-h-screen relative overflow-hidden">
    <div class="absolute inset-0 z-0 pointer-events-none opacity-[0.05]"
         style="background-image: radial-gradient(circle, #fff 1px, transparent 1px); background-size: 18px 18px;">
    </div>

    <div class="container mx-auto px-5 xl:px-12 pt-28 pb-20 relative z-10 max-w-3xl">
        {{-- Header --}}
        <div class="bg-primary border-3 border-black shadow-brutal px-6 py-4 inline-block rotate-[-1deg] mb-10">
            <h1 class="text-xl sm:text-2xl lg:text-3xl font-extrabold uppercase text-black flex items-center gap-2">
                <x-heroicon-o-document-text class="w-6 h-6 sm:w-7 sm:h-7" /> Terms of Service
            </h1>
        </div>

        <div class="card-brutal bg-surface p-6 sm:p-8 lg:p-10 text-black">
            <p class="mb-6 leading-relaxed text-sm lg:text-base font-medium">Welcome to IGX (Indonesia Game Expo). These Terms of Service ("Terms") govern your use of our website <a href="https://igx.co.id" class="text-primary font-extrabold underline decoration-2">https://igx.co.id</a>, games, and related services. By accessing or participating in any IGX-related content or activities, you agree to these Terms.</p>

            <h2 class="text-lg font-extrabold uppercase mt-8 mb-3 border-b-3 border-black pb-2">1. Use of the Website</h2>
            <ul class="list-disc pl-5 sm:pl-6 mb-6 space-y-2 text-sm lg:text-base">
                <li>IGX provides information about our events, promotions, and interactive games.</li>
                <li>You may browse the website without creating an account.</li>
                <li>Participation in games may require voluntary submission of email and username.</li>
            </ul>

            <h2 class="text-lg font-extrabold uppercase mt-8 mb-3 border-b-3 border-black pb-2">2. Eligibility</h2>
            <ul class="list-disc pl-5 sm:pl-6 mb-6 space-y-2 text-sm lg:text-base">
                <li>Services intended for individuals aged 13 and above.</li>
                <li>Under 13: obtain parental consent.</li>
                <li>IGX reserves the right to restrict access for misuse.</li>
            </ul>

            <h2 class="text-lg font-extrabold uppercase mt-8 mb-3 border-b-3 border-black pb-2">3. Leaderboard & Prize Rules</h2>
            <ul class="list-disc pl-5 sm:pl-6 mb-6 space-y-2 text-sm lg:text-base">
                <li>Email and username submitted after game completion may appear on leaderboard.</li>
                <li>Submission is voluntary and only used to identify winners.</li>
                <li>IGX reserves the right to disqualify false or offensive entries.</li>
            </ul>

            <h2 class="text-lg font-extrabold uppercase mt-8 mb-3 border-b-3 border-black pb-2">4. Content Ownership</h2>
            <ul class="list-disc pl-5 sm:pl-6 mb-6 space-y-2 text-sm lg:text-base">
                <li>All content is intellectual property of IGX and/or partners.</li>
                <li>No copying, distribution, or commercial use without written permission.</li>
            </ul>

            <h2 class="text-lg font-extrabold uppercase mt-8 mb-3 border-b-3 border-black pb-2">5. Prohibited Activities</h2>
            <ul class="list-disc pl-5 sm:pl-6 mb-6 space-y-2 text-sm lg:text-base">
                <li>Unlawful use of website or games.</li>
                <li>False information or impersonation.</li>
                <li>Hacking, damage, or disruption of systems.</li>
                <li>Interference with contest or leaderboard integrity.</li>
            </ul>

            <h2 class="text-lg font-extrabold uppercase mt-8 mb-3 border-b-3 border-black pb-2">6. Disclaimers</h2>
            <ul class="list-disc pl-5 sm:pl-6 mb-6 space-y-2 text-sm lg:text-base">
                <li>Services provided "as is" — no guarantee of uninterrupted operation.</li>
                <li>Not responsible for loss, damage, or data issues.</li>
            </ul>

            <h2 class="text-lg font-extrabold uppercase mt-8 mb-3 border-b-3 border-black pb-2">7. Changes to Terms</h2>
            <ul class="list-disc pl-5 sm:pl-6 mb-6 space-y-2 text-sm lg:text-base">
                <li>IGX may update Terms anytime. Continued use = acceptance.</li>
            </ul>

            <h2 class="text-lg font-extrabold uppercase mt-8 mb-3 border-b-3 border-black pb-2">8. Contact</h2>
            <p class="text-sm lg:text-base mb-2">📧 <a href="mailto:indonesiagameexpo23@gmail.com" class="text-primary font-extrabold underline decoration-2">indonesiagameexpo23@gmail.com</a></p>
        </div>
    </div>
</div>
@endsection
