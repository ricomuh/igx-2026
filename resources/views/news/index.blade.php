@extends('layouts.main', [
    'title' => 'News',
])
@section('content')
<div class="text-dark bg-white pb-12">
    <div class="container mx-auto px-12 pt-24">
        {{-- Popular News --}}
        @include('components.news.popular')
        
        {{-- Latest News --}}
        @include('components.news.latest')
    </div>
</div>
@endsection