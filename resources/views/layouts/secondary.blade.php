<!DOCTYPE html>
<html class="h-full" data-theme="true" data-theme-mode="light" lang="en">
<!--begin::Head-->

<head>
    <title>{{ isset($title) ? $title . ' | ' . env('APP_NAME') : env('APP_NAME') }}</title>
    @include('layouts.partials.style')
</head>

<body class="h-full">
    @include('layouts.partials.navbar')
    <!--begin::Content-->
    <main id="content">
        <div>
            @yield('content')
        </div>
    </main>

    @yield('scripts')
</body>

</html>
