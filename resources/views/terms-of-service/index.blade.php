@extends('layouts.main', [
    'title' => 'Terms of Service',
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
    <div class="relative z-10">
        <h1 class="text-2xl lg:text-3xl xl:text-4xl font-extrabold mb-8 md:mb-10">Terms of Service – IGX (Indonesia Game Expo)</h1>
        <p class="mb-6 leading-relaxed text-sm lg:text-base">Welcome to IGX (Indonesia Game Expo). These Terms of Service ("Terms") govern your use of our website <a href="https://igx.co.id" class="text-primary">https://igx.co.id</a>, games, and related services. By accessing or participating in any IGX-related content or activities, you agree to these Terms. If you do not agree, please do not use our services.</p>
        <h2 class="md:text-lg lg:text-xl xl:text-2xl font-bold mt-6 lg:mt-8 mb-2 lg:mb-4">1. Use of the Website and Services</h2>
        <ul class="list-disc pl-5 sm:pl-6 mb-6 space-y-2 text-sm lg:text-base">
            <li>IGX provides information about our events, promotions, and interactive games.</li>
            <li>You may browse the website without creating an account or submitting personal information.</li>
            <li>Participation in games or contests may require you to voluntarily submit your email and username, especially if you wish to appear on the leaderboard or be eligible for prizes.</li>
        </ul>
        <h2 class="md:text-lg lg:text-xl xl:text-2xl font-bold mt-6 lg:mt-8 mb-2 lg:mb-4">2. Eligibility</h2>
        <ul class="list-disc pl-5 sm:pl-6 mb-6 space-y-2 text-sm lg:text-base">
            <li>Our services are intended for individuals aged 13 and above.</li>
            <li>If you are under 13, please obtain parental consent or do not submit any personal information.</li>
            <li>IGX reserves the right to restrict access to services if any misuse or violation of these Terms is detected.</li>
        </ul>
        <h2 class="md:text-lg lg:text-xl xl:text-2xl font-bold mt-6 lg:mt-8 mb-2 lg:mb-4">3. Leaderboard & Prize Rules</h2>
        <ul class="list-disc pl-5 sm:pl-6 mb-6 space-y-2 text-sm lg:text-base">
            <li>Participants who submit their email and username after completing a game may be displayed on the leaderboard.</li>
            <li>Submitting information is voluntary and only used to identify winners and deliver prizes.</li>
            <li>IGX reserves the right to verify eligibility and disqualify entries that contain false, offensive, or misleading information.</li>
        </ul>
        <h2 class="md:text-lg lg:text-xl xl:text-2xl font-bold mt-6 lg:mt-8 mb-2 lg:mb-4">4. Content Ownership</h2>
        <ul class="list-disc pl-5 sm:pl-6 mb-6 space-y-2 text-sm lg:text-base">
            <li>All content on the IGX website, including graphics, logos, games, text, and event branding, is the intellectual property of IGX and/or its partners.</li>
            <li>You may not copy, distribute, modify, or use our content for commercial purposes without written permission from IGX.</li>
        </ul>
        <h2 class="md:text-lg lg:text-xl xl:text-2xl font-bold mt-6 lg:mt-8 mb-2 lg:mb-4">5. Prohibited Activities</h2>
        <p class="mb-2 leading-relaxed text-sm lg:text-base">You agree not to:</p>
        <ul class="list-disc pl-5 sm:pl-6 mb-6 space-y-2 text-sm lg:text-base">
            <li>Use the website or games for any unlawful purpose.</li>
            <li>Submit false information or impersonate others.</li>
            <li>Attempt to hack, damage, or disrupt our website or game systems.</li>
            <li>Interfere with the fairness or integrity of any contest or leaderboard.</li>
        </ul>
        <h2 class="md:text-lg lg:text-xl xl:text-2xl font-bold mt-6 lg:mt-8 mb-2 lg:mb-4">6. Disclaimers</h2>
        <ul class="list-disc pl-5 sm:pl-6 mb-6 space-y-2 text-sm lg:text-base">
            <li>IGX provides its services “as is” and does not guarantee uninterrupted or error-free operation of its website or games.</li>
            <li>We are not responsible for any loss, damage, or data issues arising from your use of our services.</li>
        </ul>
        <h2 class="md:text-lg lg:text-xl xl:text-2xl font-bold mt-6 lg:mt-8 mb-2 lg:mb-4">7. Limitation of Liability</h2>
        <p class="mb-2 leading-relaxed text-sm lg:text-base">IGX will not be liable for any indirect, incidental, or consequential damages arising out of your use of our services, including but not limited to:</p>
        <ul class="list-disc pl-5 sm:pl-6 mb-6 space-y-2 text-sm lg:text-base">
            <li>Failure to win a prize</li>
            <li>Errors in game scoring or leaderboard display</li>
            <li>Technical difficulties beyond our control</li>
        </ul>
        <h2 class="md:text-lg lg:text-xl xl:text-2xl font-bold mt-6 lg:mt-8 mb-2 lg:mb-4">8. Changes to the Terms</h2>
        <ul class="list-disc pl-5 sm:pl-6 mb-6 space-y-2 text-sm lg:text-base">
            <li>IGX may update these Terms at any time. Changes will be posted on this page with the updated date. By continuing to use our services after changes are made, you accept the revised Terms.</li>
        </ul>
        <h2 class="md:text-lg lg:text-xl xl:text-2xl font-bold mt-6 lg:mt-8 mb-2 lg:mb-4">9. Contact Us</h2>
        <p class="mb-2 leading-relaxed text-sm lg:text-base">If you have any questions about these Terms, please contact us at:</p>
        <p class="mb-0 leading-relaxed text-sm lg:text-base">📧 <a href="mailto:indonesiagameexpo23@gmail.com" class="text-primary">indonesiagameexpo23@gmail.com</a></p>
    </div>
  </div>
</div>
@endsection
