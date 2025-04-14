{{-- Meta tag --}}
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>{{ env('APP_NAME') }} {{ @$title ? '| ' . $title : '' }}</title>
<meta charset="utf-8" />
<meta name="description" content="{{ env('APP_NAME') }}">
<meta name="author" content="{{ env('APP_NAME') }}">
<meta name="robots" content="noindex, nofollow">

@if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css'])
@endif

@yield('style')