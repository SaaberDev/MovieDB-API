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

        public function releaseYears($page = 1)
        {
            $data = \Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/4/list/7096014?page=' . $page)
                ->json()['results'];

//            $explode = [];
//            foreach ($data as $datum) {
//                $slice = explode('-', $datum['release_date']);
//                $explode[] = \Arr::first($slice);
//            }
//            dd($explode);
            return collect($data);
        }
    }
