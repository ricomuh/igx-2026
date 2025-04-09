@extends('layouts.main', [
    'title' => 'Home',
])
@section('content')
    {{-- Banner --}}
    @include('components.home.banner')
@endsection