@extends('layouts.main', [
    'title' => 'News',
])

@section('content')
<div class="container mx-auto px-5 xl:px-12 pt-24 overflow-hidden text-dark bg-white">
    {{-- Popular News --}}
    @include('components.news.popular')
    
    {{-- Latest News --}}
    @include('components.news.latest')
</div>
@endsection

