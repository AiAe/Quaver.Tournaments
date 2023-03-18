<div>
    <ul>
        {{-- TODO: Implement map list design --}}
        @forelse($maps as $map)
            <li>
                {{$map->map}} {{$map->mods}}
            </li>
        @empty
            <li>No maps...</li>
        @endforelse
    </ul>
</div>
