<?php


    namespace App\Repository;


    class MovieDB
    {
        public function all($page = 1)
        {
            $data = \Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/4/list/7096014?page=' . $page)
                ->json()['results'];
            return collect($data);
        }

        public function topRated()
        {
            $data = \Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/movie/top_rated')
                ->json()['results'];
            return collect($data);
        }

        public function popular()
        {
            $data = \Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/movie/popular')
                ->json()['results'];
            return collect($data);
        }

        public function genres()
        {
            $data = \Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/genre/movie/list')
                ->json()['genres'];
            return collect($data);
        }

        public function search($key, $page)
        {
            $data = \Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/search/movie?include_adult=false&query=' . $key . '&page=' . $page)
                ->json()['results'];
            return collect($data);
        }
    }
