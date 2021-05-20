@extends('layouts.app')
@section('title', 'MovieTalk')
@push('styles')
    <style>
        .slider img {
            max-width: 100%;
            width: 100%;
            height: 790px;
            display: block;
            object-fit: contain;
        }
        .tagline {
            border-left: 14px solid #ffaa3c;
            padding: 18px;
            margin-bottom: 30px;
            margin-left: 16px;
            background-color: rgb(255 169 60 / 20%);
        }
    </style>
@endpush

@section('content')
    <div class="page">
        <div class="row">
            <div class="col-md-9">
                <div class="slider">
                    <ul class="slides">
                        <p class="tagline">Top Rated</p>
                        @forelse($topRatedMovies as $topRatedMovie)
                            <li><a href="#"><img class="img-fluid" src="{{ 'https://image.tmdb.org/t/p/w500' . $topRatedMovie['poster_path'] }}" alt="Slide 1"></a></li>
                        @empty
                            <li><a href="#"><img src="{{ asset('_assets/images/dummy/slide-1.jpg') }}" alt="Slide 1"></a></li>
                        @endforelse
                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                <div class="row">
                    <p class="tagline">Popular</p>
                    @forelse($popularMoviesRight as $popularMovie)
                    <div class="col-sm-6 col-md-12">
                        <div class="latest-movie">
                            <a href="#"><img src="{{ 'https://image.tmdb.org/t/p/w500' . $popularMovie['poster_path'] }}" alt="Movie 1"></a>
                        </div>
                    </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div> <!-- .row -->
        <div class="row">
            <p class="tagline">More Popular</p>
            @forelse($popularMoviesBottom as $popularMovie)
            <div class="col-sm-6 col-md-3">
                <div class="latest-movie">
                    <a href="#"><img src="{{ 'https://image.tmdb.org/t/p/w500' . $popularMovie['poster_path'] }}" alt="Movie 3"></a>
                </div>
            </div>
            @empty
            @endforelse
        </div> <!-- .row -->
    </div>
@endsection

@push('scripts')
@endpush
