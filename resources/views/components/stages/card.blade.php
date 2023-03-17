{{-- TODO: Implement stage card design --}}
<div class="card">
    <div class="card-header">
        {{$stage->name}}
    </div>
    <ul>
        @forelse($stage->rounds as $round)
            <li>{{$round->name}}</li>
        @empty
            <li>No rounds...</li>
        @endforelse
    </ul>
</div>
