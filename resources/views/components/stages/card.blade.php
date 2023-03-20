{{-- TODO: Implement stage card design --}}
<div class="card">
    <div class="card-header">
        {{$stage->name}}
    </div>
    <ul>
        @forelse($stage->rounds as $round)
            <li>
                <a href="{{route('web.tournaments.rounds.show', ['tournament' => $tournament, 'round' => $round])}}">
                    {{$round->name}}
                </a>
            </li>
        @empty
            <li>No rounds...</li>
        @endforelse
    </ul>
</div>
