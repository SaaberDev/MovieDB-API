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
        $i = 0;
        $data = [];

        if (empty($search)) {
            return \Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/4/list/7096014')
                ->collect('results');
        } else {
            $movieLists = \Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/4/list/7096014')
                ->collect('results');

            // filling an array of indexes $ar
            foreach ($movieLists as $movieList){
                if (strstr(strtolower($movieList['original_title']), strtolower($search))) array_push ($data, $movieLists[$i]);
                $i++;
            }
        }
        return $data;
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
//        $search = $this->search;
        $allMovies = $this->search();
        $allMovies = $this->paginate($allMovies, $this->recordPerPage, $this->page);
//        dd($allMovies);
//        $allMovies = $this->paginate($allMovies, $this->recordPerPage);
//        dd($m->links());
        $genres = $this->genres();
        return view('livewire.movies-component', compact('allMovies', 'genres'));
    }



    // TODO -- [ Paginate, Filter by Genres, Page item ]
}
