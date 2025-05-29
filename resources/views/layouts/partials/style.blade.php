{{-- Meta tag --}}
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>{{ @$title ? $title . ' | ' : '' }}{{ env('APP_NAME') }}</title>

<meta name="description" content="{{ @$description ?? env('APP_DESCRIPTION', 'Indonesia Game Xperience - The Ultimate Gaming Event in Indonesia') }}">
<meta name="keywords" content="IGX, Indonesia Game Xperience, Gaming Event, Esports, Convention, ICE BSD, Game Festival, {{ @$keywords ?? '' }}">
<meta name="author" content="{{ env('APP_AUTHOR', env('APP_NAME')) }}">
<meta name="robots" content="index, follow">
<meta property="og:title" content="{{ @$title ? $title . ' | ' : '' }}{{ env('APP_NAME') }}">
<meta property="og:description" content="{{ @$description ?? env('APP_DESCRIPTION', 'Indonesia Game Xperience - The Ultimate Gaming Event in Indonesia') }}">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:image" content="{{ @$og_image ?? asset('media/images/logos/logo.svg') }}">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ @$title ? $title . ' | ' : '' }}{{ env('APP_NAME') }}">
<meta name="twitter:description" content="{{ @$description ?? env('APP_DESCRIPTION', 'Indonesia Game Xperience - The Ultimate Gaming Event in Indonesia') }}">
<meta name="twitter:image" content="{{ @$og_image ?? asset('media/images/logos/logo.svg') }}">

@if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite('resources/css/app.css')
@endif
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

@stack('style')