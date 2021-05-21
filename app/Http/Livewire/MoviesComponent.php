<?php

namespace App\Http\Livewire;

use App\Repository\MovieDB;
use Illuminate\Pagination\Paginator;
use Livewire\Component;
use Livewire\WithPagination;

class MoviesComponent extends Component
{
    use WithPagination;

    public $search = '';
    public $recordPerPage = 15;
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

    public function all()
    {
        $data = \Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/4/list/7096014?page=' . $this->page)
            ->json()['results'];
        return collect($data);
    }

    public function search()
    {
        $search = $this->search;
        if (empty($search)) {
            $data = \Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/4/list/7096014?page=' . $this->page)
                ->json()['results'];
        } else {
            $data = \Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/search/movie?include_adult=false&query=' . $search . '&page=' . $this->page)
                ->json()['results'];
        }
        return collect($data);
    }

    public function genres()
    {
        $data = \Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/movie/list')
            ->json()['genres'];
        return collect($data);
    }

    public function previousPage()
    {
        //
    }

    public function gotoPage()
    {
        //
    }

    public function nextPage()
    {
        //
    }

    public function render()
    {
        $allMovies = $this->search();
        $genres = $this->genres();
        return view('livewire.movies-component', compact('allMovies', 'genres'));
    }



    // TODO -- [ Paginate, Filter by Genres, Page item ]
}
