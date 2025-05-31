@extends('layouts.main', [
    'title' => 'Privacy Policy',
])

@push('style')
<style>
    body {
        background-color: var(--color-primary) !important;
    }
    .terms-bg {
        position: fixed;
        inset: 0;
        z-index: 0;
        pointer-events: none;
        background: url('/media/images/illustrations/banner.webp') no-repeat center center;
        background-size: contain;
        opacity: 0.08;
    }
</style>
@endpush

@section('content')
<div class="terms-bg"></div>
<div class="container mx-auto px-3 sm:px-5 xl:px-12 pt-24 sm:pt-32 relative z-10">
    <div class="p-5 sm:p-6 md:p-8 lg:p-7 xl:p-8 rounded-2xl shadow-lg mx-auto bg-white/60 overflow-hidden">
        <div class="relative z-10 text-gray-800">
            <h1 class="text-2xl lg:text-3xl xl:text-4xl font-extrabold mb-8 md:mb-10">Privacy Policy – IGX (Indonesia Game Expo)</h1>
            <p class="mb-4 lg:mb-6 leading-relaxed text-sm lg:text-base">This Privacy Policy outlines how IGX (Indonesia Game Expo) handles your personal data when you visit our website (igx.co.id) or participate in our events and games. We are committed to protecting your privacy and complying with Indonesia’s Personal Data Protection Law (PDPL – Law No. 27 of 2022).</p>
            <h2 class="md:text-lg lg:text-xl xl:text-2xl font-bold mt-6 lg:mt-8 mb-2 lg:mb-4">Information We Collect</h2>
            <ul class="list-disc pl-5 sm:pl-6 mb-6 space-y-2 text-sm lg:text-base">
                <li><span class="font-bold">Website Visitors:</span> We do not collect or store any personal information when you visit igx.co.id. Basic technical information (such as IP address, browser type, or pages visited) may be processed automatically for security and functionality purposes, but this information is not linked to any personally identifiable data.</li>
                <li><span class="font-bold">Game Participants:</span> If you play an IGX game and choose to enter your email and username after completing the game, this data will be collected voluntarily. It is used solely for:
                    <ul class="list-disc pl-5 sm:pl-6 mt-2">
                        <li>Displaying your score on the leaderboard</li>
                        <li>Contacting you if you are selected as a prize winner</li>
                    </ul>
                </li>
                <li><span class="font-bold">Event Registrants:</span> Any personal data submitted during ticket registration is handled entirely by the third-party ticketing marketplace. IGX does not collect or store this registration data directly.</li>
            </ul>
            <h2 class="md:text-lg lg:text-xl xl:text-2xl font-bold mt-6 lg:mt-8 mb-2 lg:mb-4">How We Use Your Information</h2>
            <p class="mb-4 leading-relaxed text-sm lg:text-base">The personal information (email and username) submitted through the IGX game will only be used to:</p>
            <ul class="list-disc pl-5 sm:pl-6 mb-6 space-y-2 text-sm lg:text-base">
                <li>Display rankings on the game leaderboard</li>
                <li>Contact winners for prize distribution</li>
            </ul>
            <p class="mb-4 lg:mb-6 leading-relaxed text-sm lg:text-base">We will not use this data for marketing, third-party sharing, or any other purposes outside of the scope mentioned above.</p>
            <h2 class="md:text-lg lg:text-xl xl:text-2xl font-bold mt-6 lg:mt-8 mb-2 lg:mb-4">Third Parties</h2>
            <ul class="list-disc pl-5 sm:pl-6 mb-6 space-y-2 text-sm lg:text-base">
                <li><span class="font-bold">Analytics & Ads:</span> IGX does not use third-party services like Google Analytics, Facebook Pixel, or similar tools. We do not track, share, or analyze visitor behavior for commercial purposes.</li>
                <li><span class="font-bold">Ticket Sales Platform:</span> As mentioned, event registration data is collected and processed by an external ticketing marketplace, and its privacy practices are governed by their own policy, not by IGX.</li>
            </ul>
            <h2 class="md:text-lg lg:text-xl xl:text-2xl font-bold mt-6 lg:mt-8 mb-2 lg:mb-4">Data Storage & Security</h2>
            <p class="mb-4 leading-relaxed text-sm lg:text-base">We take appropriate technical and organizational measures to safeguard your personal data. Data submitted for the game (email and username) is securely stored with access limited to authorized IGX personnel.</p>
            <p class="mb-4 lg:mb-6 leading-relaxed text-sm lg:text-base">Once the event concludes and prizes are distributed, we will delete or anonymize the data to ensure it is no longer retained unnecessarily.</p>
            <h2 class="md:text-lg lg:text-xl xl:text-2xl font-bold mt-6 lg:mt-8 mb-2 lg:mb-4">Your Rights</h2>
            <p class="mb-4 leading-relaxed text-sm lg:text-base">Under applicable data protection laws, you have the right to:</p>
            <ul class="list-disc pl-5 sm:pl-6 mb-6 space-y-2 text-sm lg:text-base">
                <li><span class="font-bold">Access Your Data:</span> Request a copy of your personal data that we hold.</li>
                <li><span class="font-bold">Correct Your Data:</span> Ask us to correct any inaccurate or incomplete information.</li>
                <li><span class="font-bold">Delete Your Data:</span> Request deletion of your personal data once it’s no longer necessary or if you withdraw your consent.</li>
                <li><span class="font-bold">Withdraw Consent:</span> You can withdraw your consent at any time, after which we will stop processing and delete your data.</li>
            </ul>
            <p class="mb-4 lg:mb-6 leading-relaxed text-sm lg:text-base">To exercise these rights, please contact us using the contact information provided below.</p>
            <h2 class="md:text-lg lg:text-xl xl:text-2xl font-bold mt-6 lg:mt-8 mb-2 lg:mb-4">Contact Us</h2>
            <p class="mb-2 leading-relaxed text-sm lg:text-base">If you have any questions about this Privacy Policy or wish to access, correct, or delete your data, please contact the IGX team at:</p>
            <p class="mb-2 leading-relaxed text-sm lg:text-base">📧 <a href="mailto:indonesiagameexpo23@gmail.com" class="text-primary">indonesiagameexpo23@gmail.com</a></p>
            <p class="mb-0 leading-relaxed text-sm lg:text-base">We will respond to your request as promptly as possible and in accordance with applicable data protection regulations.</p>
        </div>
    </div>
</div>
@endsection
