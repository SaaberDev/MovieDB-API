<?php

namespace App\Http\Livewire;

use App\Repository\MovieDB;
use Livewire\Component;

class MoviesComponent extends Component
{
    private MovieDB $movieDB;

    public function mount(MovieDB $movieDB)
    {
        $this->movieDB = $movieDB;
    }

    public function render()
    {
        $allMovies = $this->movieDB->all();
        return view('livewire.movies-component', compact('allMovies'));
    }
}
