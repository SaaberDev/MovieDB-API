<?php

namespace App\Http\Livewire\Filters;

use App\Repository\MovieDB;
use Livewire\Component;

class ByCategory extends Component
{
    private MovieDB $movieDB;

    public function mount(MovieDB $movieDB)
    {
        $this->movieDB = $movieDB;
    }

    public function render()
    {
        $genres = $this->movieDB->genres();
        return view('livewire.filters.by-category', compact('genres'));
    }
}
