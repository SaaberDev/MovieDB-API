<div>
    @forelse($allMovies as $allMovie)
        <div class="movie">
            <figure class="movie-poster"><img src="{{ 'https://image.tmdb.org/t/p/w500' . $allMovie['poster_path'] }}" alt="#"></figure>
            <div class="movie-title"><a href="#sign_in">{{ $allMovie['original_title'] }}</a></div>
            <p>{{ Str::limit($allMovie['overview'], 60) }}</p>
        </div>
    @empty
        No Movies available.
    @endforelse
</div>
