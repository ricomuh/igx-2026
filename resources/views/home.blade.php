@extends('layouts.main', [
    'title' => 'Home',
])
@section('content')
    {{-- Banner --}}
    @include('components.home.banner')
    
    {{-- Countdown --}}
    @include('components.home.countdown')

    {{-- Gallery --}}
    @include('components.home.gallery')
@endsection