<div>
    <ul>
        {{-- TODO: Implement match list design --}}
        @php($matches->load(['team1', 'team2']))
        @forelse($matches as $match)
            <li>{{$match->timestamp}} {{$match->team1->name}} vs {{$match->team2->name}}</li>
        @empty
            <li>No matches...</li>
        @endforelse
    </ul>
</div>
