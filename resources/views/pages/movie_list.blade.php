@extends('layouts.app')
@section('title', 'Movies')
@push('styles')
    <style>
        .search {
            display: inline-flex;
            float: right;
        }
    </style>
@endpush

@section('content')
    <div class="page">
        <div class="breadcrumbs">
            <a href="index.html">Home</a>
            <span>Movie Review</span>
        </div>

        <div class="filters">
            @include('includes.filter_by_category')
            @include('includes.filter_by_year')
            <div class="search">
                @include('includes.search')
            </div>
        </div>

        <div class="movie-list">
            <div class="movie">
                <figure class="movie-poster"><img src="{{ asset('_assets/images/dummy/thumb-3.jpg') }}" alt="#"></figure>
                <div class="movie-title"><a href="single.html">Maleficient</a></div>
                <p>Sed ut perspiciatis unde omnis iste natus error voluptatem doloremque.</p>
            </div>
            <div class="movie">
                <figure class="movie-poster"><img src="{{ asset('_assets/images/dummy/thumb-4.jpg') }}" alt="#"></figure>
                <div class="movie-title"><a href="single.html">The adventure of Tintin</a></div>
                <p>Sed ut perspiciatis unde omnis iste natus error voluptatem doloremque.</p>
            </div>
            <div class="movie">
                <figure class="movie-poster"><img src="{{ asset('_assets/images/dummy/thumb-5.jpg') }}" alt="#"></figure>
                <div class="movie-title"><a href="single.html">Hobbit</a></div>
                <p>Sed ut perspiciatis unde omnis iste natus error voluptatem doloremque.</p>
            </div>
            <div class="movie">
                <figure class="movie-poster"><img src="{{ asset('_assets/images/dummy/thumb-6.jpg') }}" alt="#"></figure>
                <div class="movie-title"><a href="single.html">Exists</a></div>
                <p>Sed ut perspiciatis unde omnis iste natus error voluptatem doloremque.</p>
            </div>
            <div class="movie">
                <figure class="movie-poster"><img src="{{ asset('_assets/images/dummy/thumb-1.jpg') }}" alt="#"></figure>
                <div class="movie-title"><a href="single.html">Drive hard</a></div>
                <p>Sed ut perspiciatis unde omnis iste natus error voluptatem doloremque.</p>
            </div>
            <div class="movie">
                <figure class="movie-poster"><img src="{{ asset('_assets/images/dummy/thumb-2.jpg') }}" alt="#"></figure>
                <div class="movie-title"><a href="single.html">Robocop</a></div>
                <p>Sed ut perspiciatis unde omnis iste natus error voluptatem doloremque.</p>
            </div>
            <div class="movie">
                <figure class="movie-poster"><img src="{{ asset('_assets/images/dummy/thumb-7.jpg') }}" alt="#"></figure>
                <div class="movie-title"><a href="single.html">Life of Pi</a></div>
                <p>Sed ut perspiciatis unde omnis iste natus error voluptatem doloremque.</p>
            </div>
            <div class="movie">
                <figure class="movie-poster"><img src="{{ asset('_assets/images/dummy/thumb-8.jpg') }}" alt="#"></figure>
                <div class="movie-title"><a href="single.html">The Colony</a></div>
                <p>Sed ut perspiciatis unde omnis iste natus error voluptatem doloremque.</p>
            </div>
        </div> <!-- .movie-list -->

        @include('includes.pagination')
    </div>
@endsection

@push('scripts')
@endpush
