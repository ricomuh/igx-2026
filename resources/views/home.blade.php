@extends('layouts.main', [
    'title' => 'Home',
])
@section('content')
<div class="bg-bg">
    {{-- Banner --}}
    @include('components.home.banner')

    {{-- Play game --}}
    @include('components.home.play')

    {{-- Countdown --}}
    @include('components.home.countdown')

    {{-- Gallery --}}
    @include('components.home.gallery')

    {{-- Sponsor --}}
    @include('components.home.sponsor')
</div>
@endsection
