<select wire:model="filter" placeholder="Choose Category">
    <option value="" selected disabled>Filter By</option>
    @forelse($genres as $genre)
        <option value="{{ $genre['id'] }}">{{ $genre['name'] }}</option>
    @empty
        No Genres Available
    @endforelse
</select>

<button wire:click="clearFilter">
    <i class="fa fa-repeat">{{ $filter }}</i>
</button>
