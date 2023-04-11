<?php

namespace App\Http\Livewire\Tournaments;

use App\Models\TournamentMatch;
use App\Models\TournamentMatchFfaParticipants;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MatchParticipant extends Component
{
    use AuthorizesRequests;
    use WithRateLimiting;

    public $player_in_stage_round;
    public $match;
    public $tournament;
    public $loggedUser;

    public function mount(TournamentMatch $match, $player_in_stage_round)
    {
        $match->load(['round']);
        $this->match = $match;
        $this->player_in_stage_round = $player_in_stage_round;

        $this->tournament = request()->attributes->get('tournament');
        $this->loggedUser = request()->attributes->get('loggedUser');
    }

    public function join()
    {
        $player = Auth::user();

        $this->authorize('assignTeamToQualifierLobby', $this->match);

        $participants_count = $this->match->ffaParticipants()->count();

        if ($participants_count >= 10) {
            createToast('error', '', __('Lobby is full!'));
            return redirect(request()->header('Referer'));
        }

        $team = $player->teams()->firstWhere('tournament_id', $this->tournament->id);

        // Check if team already in stage matches
        $player_in_stage_round = TournamentMatchFfaParticipants::query()
            ->where('tournament_stage_round_id', $this->match->round->id)
            ->where('team_id', $team->id)
            ->exists();

        if (!$player_in_stage_round) {
            $this->match->ffaParticipants()->attach($team, [
                'tournament_stage_round_id' => $this->match->round->id
            ]);

            createToast('success', '', __('Added'));
        } else {
            createToast('error', '', __('Withdraw before joining another lobby'));
        }

        return redirect(request()->header('Referer'));
    }

    public function leave()
    {
        try {
            $this->rateLimit(1, 30);

            $player = Auth::user();

            $this->authorize('withdrawTeamFromQualifierLobby', $this->match);

            $team = $player->teams()->firstWhere('tournament_id', $this->tournament->id);

            // Find player
            $player_in_stage_round = TournamentMatchFfaParticipants::query()
                ->where('tournament_stage_round_id', $this->match->round->id)
                ->where('team_id', $team->id)
                ->first();

            if($player_in_stage_round) {
                $player_in_stage_round->delete();

                createToast('success', '', __('Successfully withdrawn from the lobby!'));
            } else {
                createToast('error', '', __('You are not playing in this lobby!'));
            }
        } catch (TooManyRequestsException $tooManyRequestsException) {
            createToast('error', '', __('You reached your maximum withdraws for today!'));
        }

        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('livewire.tournaments.match-participant');
    }
}
