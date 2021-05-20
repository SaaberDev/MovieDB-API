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
            <a href="{{ route('guest.home') }}">Home</a>
            <span>Movie Review</span>
        </div>

        <div class="filters">
            @include('includes.filter_by_category')
            @include('includes.filter_by_year')
            <span>Per Page</span>
            @include('includes.filter_by_limit')
            <div class="search">
                @include('includes.search')
            </div>
        </div>

        <div class="movie-list">
            @forelse($allMovies as $allMovie)
                <div class="movie">
                    <figure class="movie-poster"><img src="{{ 'https://image.tmdb.org/t/p/w500' . $allMovie['poster_path'] }}" alt="#"></figure>
                    <div class="movie-title"><a href="#sign_in">{{ $allMovie['original_title'] }}</a></div>
                    <p>{{ Str::limit($allMovie['overview'], 60) }}</p>
                </div>
            @empty
                No Movies available.
            @endforelse
        </div> <!-- .movie-list -->

        @include('includes.pagination')
    </div>
@endsection

@push('scripts')
@endpush
