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

        public function allMovies()
        {
            return \Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/4/list/7096014')
                ->collect('results');
        }

//        public function search()
//        {
//            if (empty($search)) {
//                return \Http::withToken(config('services.tmdb.token'))
//                    ->get('https://api.themoviedb.org/4/list/7096014')
//                    ->collect('results');
//            } else {
//                $movieLists = \Http::withToken(config('services.tmdb.token'))
//                    ->get('https://api.themoviedb.org/4/list/7096014')
//                    ->collect('results');
//
//                // filling an array of indexes $ar
//                foreach ($movieLists as $movieList){
//                    if (strstr(strtolower($movieList['original_title']), strtolower($search))) array_push ($data, $movieLists[$i]);
//                    $i++;
//                }
//            }
//            return $data;
//        }
    }
