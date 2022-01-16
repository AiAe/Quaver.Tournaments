<div class="card">
    <a href="{{ route('quaverUser', $player['id']) }}" target="_blank">
        <img src="{{ $player['avatar_url'] }}" class="img-fluid card-img-top" alt="{{ $player['username'] }}">
    </a>
    <div class="card-footer" style="padding: 0.5rem 0.5rem">
        <a href="{{ route('quaverUser', $player['id']) }}" target="_blank">
            {{ $player['username'] }}
        </a>
    </div>
</div>
