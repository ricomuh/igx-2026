@extends('layouts.main', ['title' => 'Privacy Policy'])

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
        <div class="bg-cyan border-3 border-black shadow-brutal px-6 py-4 inline-block rotate-[-1deg] mb-10">
            <h1 class="text-xl sm:text-2xl lg:text-3xl font-extrabold uppercase text-black flex items-center gap-2">
                <x-heroicon-o-shield-check class="w-6 h-6 sm:w-7 sm:h-7" /> Privacy Policy
            </h1>
        </div>

        <div class="card-brutal bg-surface p-6 sm:p-8 lg:p-10 text-black">
            <p class="mb-6 leading-relaxed text-sm lg:text-base font-medium">This Privacy Policy outlines how IGX handles your personal data when you visit our website or participate in our events and games. We comply with Indonesia's Personal Data Protection Law (PDPL – Law No. 27 of 2022).</p>

            <h2 class="text-lg font-extrabold uppercase mt-8 mb-3 border-b-3 border-black pb-2">Information We Collect</h2>
            <ul class="list-disc pl-5 sm:pl-6 mb-6 space-y-2 text-sm lg:text-base">
                <li><span class="font-extrabold">Website Visitors:</span> No personal information collected. Basic technical data may be processed automatically for security purposes only.</li>
                <li><span class="font-extrabold">Game Participants:</span> Email and username submitted voluntarily — used only for leaderboard display and prize winner contact.</li>
                <li><span class="font-extrabold">Event Registrants:</span> Data handled entirely by third-party ticketing marketplace. IGX does not collect registration data.</li>
            </ul>

            <h2 class="text-lg font-extrabold uppercase mt-8 mb-3 border-b-3 border-black pb-2">How We Use Your Information</h2>
            <ul class="list-disc pl-5 sm:pl-6 mb-6 space-y-2 text-sm lg:text-base">
                <li>Display rankings on the game leaderboard</li>
                <li>Contact winners for prize distribution</li>
            </ul>
            <p class="text-sm lg:text-base mb-4">No marketing, third-party sharing, or other purposes.</p>

            <h2 class="text-lg font-extrabold uppercase mt-8 mb-3 border-b-3 border-black pb-2">Third Parties</h2>
            <ul class="list-disc pl-5 sm:pl-6 mb-6 space-y-2 text-sm lg:text-base">
                <li><span class="font-extrabold">Analytics:</span> IGX does not use Google Analytics, Facebook Pixel, or similar tracking tools.</li>
                <li><span class="font-extrabold">Ticket Platform:</span> Event registration data governed by external platform's own privacy policy.</li>
            </ul>

            <h2 class="text-lg font-extrabold uppercase mt-8 mb-3 border-b-3 border-black pb-2">Data Storage & Security</h2>
            <p class="text-sm lg:text-base mb-4">Data securely stored with access limited to authorized IGX personnel. Deleted or anonymized after event concludes.</p>

            <h2 class="text-lg font-extrabold uppercase mt-8 mb-3 border-b-3 border-black pb-2">Your Rights</h2>
            <ul class="list-disc pl-5 sm:pl-6 mb-6 space-y-2 text-sm lg:text-base">
                <li><span class="font-extrabold">Access</span> — Request a copy of your data</li>
                <li><span class="font-extrabold">Correct</span> — Fix inaccurate information</li>
                <li><span class="font-extrabold">Delete</span> — Request deletion when no longer necessary</li>
                <li><span class="font-extrabold">Withdraw Consent</span> — Stop processing and delete data</li>
            </ul>

            <h2 class="text-lg font-extrabold uppercase mt-8 mb-3 border-b-3 border-black pb-2">Contact</h2>
            <p class="text-sm lg:text-base mb-2">📧 <a href="mailto:indonesiagameexpo23@gmail.com" class="text-primary font-extrabold underline decoration-2">indonesiagameexpo23@gmail.com</a></p>
        </div>
    </div>
</div>
@endsection
