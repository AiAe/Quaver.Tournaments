<div wire:ignore.self>
    @if($notification['type'] == \App\Notifications\TeamInvite::class)
        @php($data = $notification['data'])
        <div class="dropdown-item d-flex py-3 notification">
            <div>
                <div class="text-wrap">
                    {!! __('<strong>:sender</strong> invited you to their team <a href=":team_url">:team</a> to play in <a href=":tournament_url">:tournament</a>', ['sender' => $data['sender']['username'], 'team_url' => route('web.tournaments.teams.show', ['tournament' => $data['tournament']['slug'], 'team' => $data['team']['slug']]),'team' => $data['team']['name'], 'tournament_url' => route('web.tournaments.show', ['tournament' => $data['tournament']['slug']]), 'tournament' => $data['tournament']['name']]) !!}
                </div>
                <span>{{ $notification->created_at->diffForHumans(['parts' => 1, 'short' => true]) }}</span>
                <div class="mt-2">
                    <button class="btn btn-success btn-sm" wire:click="accept">{{ __('Accept') }}</button>
                    <button class="btn btn-danger btn-sm" wire:click="decline">{{ __('Decline') }}</button>
                </div>
            </div>
        </div>
    @endif
</div>
