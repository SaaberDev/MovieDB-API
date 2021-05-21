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
            @livewire('filters.by-category')
            <span>Per Page</span>
            @livewire('filters.by-per-page-limit')
            <div class="search">
                @include('includes.search')
            </div>
        </div>

        <div class="movie-list">
            @livewire('movies-component')
        </div> <!-- .movie-list -->

        @include('includes.pagination')
    </div>
@endsection

@push('scripts')
@endpush
