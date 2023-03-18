<div>
    <ul>
        {{-- TODO: Implement match list design --}}
        @forelse($matches as $match)
            <li>{{$match->timestamp}} {{$match->team1->name}} vs {{$match->team2->name}}</li>
        @empty
            <li>No matches...</li>
        @endforelse
    </ul>
</div>
