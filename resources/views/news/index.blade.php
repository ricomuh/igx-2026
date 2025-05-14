@extends('layouts.main', [
    'title' => 'News',
])

@section('content')
<div class="container mx-auto px-5 md:px-12 pt-24 overflow-hidden text-dark bg-white pb-12">
    {{-- Popular News --}}
    @include('components.news.popular')
    
    {{-- Latest News --}}
    @include('components.news.latest')
</div>
@endsection

