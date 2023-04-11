<div>
    @php($team = $loggedUser->teams()->firstWhere('tournament_id', $tournament->id))
    @php($player_in_stage_round = \App\Models\TournamentMatchFfaParticipants::query()
            ->where('tournament_stage_round_id', $this->match->round->id)
            ->where('team_id', $team->id)
            ->first())

    @if($player_in_stage_round && $match->id == $player_in_stage_round->tournament_match_id)
        <button type="button" wire:click="leave" class="btn btn-danger btn-sm">{{ __('Withdraw') }}</button>
    @elseif(empty($player_in_stage_round))
        <button type="button" wire:click="join" class="btn btn-primary btn-sm">{{ __('Join') }}</button>
    @else
        -
    @endif
</div>
