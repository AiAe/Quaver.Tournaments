<div class="card">
    <img src="{{ $player['avatar_url'] }}" class="img-fluid card-img-top" alt="{{ $player['username'] }}">
    <div class="card-footer">
        <a href="{{ route('quaver', $player['id']) }}">
            {{ $player['username'] }}
        </a>
    </div>
</div>
