@extends('layouts.main', [
    'title' => 'Home',
])
@section('content')
<div class="bg-primary">
    {{-- Banner --}}
    @include('components.home.banner')
    
    {{-- Countdown --}}
    @include('components.home.countdown')

    {{-- Gallery --}}
    @include('components.home.gallery')

    {{-- Sponsor --}}
    @include('components.home.sponsor')
</div>
@endsection