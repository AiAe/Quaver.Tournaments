<div>
    @can('withdrawTeamFromQualifierLobby', $match)
        <button type="button" wire:click="leave" class="btn btn-danger btn-sm">{{ __('Withdraw') }}</button>
    @endcan
    @can('assignTeamToQualifierLobby', $match)
        <button type="button" wire:click="join" class="btn btn-primary btn-sm">{{ __('Join') }}</button>
    @endcan
</div>
