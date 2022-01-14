<div class="card">
    <a href="{{ route('quaverUser', $player['id']) }}" target="_blank">
        <img src="{{ $player['avatar_url'] }}" class="img-fluid card-img-top" alt="{{ $player['username'] }}">
    </a>
    <div class="card-footer">
        <a href="{{ route('quaverUser', $player['id']) }}" target="_blank">
            {{ Str::limit($player['username'], 12) }}
        </a>
    </div>
</div>
