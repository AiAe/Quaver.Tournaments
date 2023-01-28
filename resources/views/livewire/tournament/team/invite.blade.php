<div>
    <div class="modal fade" id="tournamentTeamInvite" tabindex="-1" aria-labelledby="tournamentTeamInviteLabel"
         wire:ignore.self
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tournamentTeamInviteLabel">{{ __('Invite players') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="create">
                    <div class="modal-body">
                        @if (session()->has('invite-success'))
                            <div class="alert alert-success">
                                {{ session('invite-success') }}
                            </div>
                        @endif
                        @if (session()->has('invite-team-not-found'))
                            <div class="alert alert-danger">
                                {{ session('invite-team-not-found') }}
                            </div>
                        @endif
                        @if (session()->has('invite-player-not-found'))
                            <div class="alert alert-danger">
                                {{ session('invite-player-not-found') }}
                            </div>
                        @endif
                        <div>
                            <label class="form-label">{{ __('Player') }}</label>
                            <input type="text" wire:model="username" class="form-control">
                            @error('username') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{ __('Send invite') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
