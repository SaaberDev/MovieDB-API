<?php

namespace App\Http\Livewire;

use App\Repository\MovieDB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class MoviesComponent extends Component
{
    use WithPagination;

    public $search = '';
    public $filter = '';
    public $recordPerPage = 8;
    public $page = 1;
    protected $movieDB;

    // Shows search query in URL
    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function mount(MovieDB $movieDB)
    {
        $this->search = '';
        $this->movieDB = $movieDB;
        $this->fill(request()->only('search', 'page'));
    }

    public function resetSearch()
    {
        $this->reset('search');
    }

    public function updatingSearch()
    {
        $this->gotoPage(1);
    }

    public function search()
    {
        $search = $this->search;
        $filter = $this->filter;
        $i = 0;
        $data = [];

        if ($search) {
            $movieLists = \Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/4/list/7096014')
                ->collect('results');

            // filling an array of indexes $ar
            foreach ($movieLists as $movieList){
                if (strstr(strtolower($movieList['original_title']), strtolower($search))) array_push ($data, $movieLists[$i]);
                $i++;
            }
        } elseif ($filter) {
            $movieLists = \Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/4/list/7096014')
                ->collect('results');

        foreach ($movieLists as $movieList) {
            if (strstr($movieList['genre_ids'][0], $filter)) array_push ($data, $movieLists[$i]);
            $i++;
        }
    } else {
        return \Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/4/list/7096014')
            ->collect('results');
    }
        return $data;
    }

    public function clearFilter()
    {
        $this->filter = '';
    }

    public function genres()
    {
        $data = \Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/movie/list')
            ->json()['genres'];
        return collect($data);
    }

    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function previousPage()
    {
        $this->setPage(max($this->page - 1, 1));
    }

    public function nextPage()
    {
        $this->setPage($this->page + 1);
    }

    public function gotoPage($page)
    {
        $this->setPage($page);
    }

    public function render()
    {
        $allMovies = $this->paginate($this->search(), $this->recordPerPage, $this->page);
//        dd($allMovies);
        $genres = $this->genres();
        return view('livewire.movies-component', compact('allMovies', 'genres'));
    }



    // TODO -- [ Filter by Genres ]
}
