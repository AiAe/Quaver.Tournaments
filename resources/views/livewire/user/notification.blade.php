<div>
    @if($notification['type'] == \App\Notifications\TeamInvite::class)
        <button type="button" class="list-group-item list-group-item-action" wire:click="open">
            {{ __(':user invited you to join their team', ['user' => $notification['data']['sender']['username']]) }}
        </button>
    @endif
</div>
