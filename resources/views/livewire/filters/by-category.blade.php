<select name="#" id="#" placeholder="Choose Category">
    @forelse($genres as $genre)
        <option value="{{ $genre['id'] }}">{{ $genre['name'] }}</option>
    @empty
        No Genres Available
    @endforelse
</select>
