<?php

namespace App\Http\Livewire\Tournaments;

use App\Models\TournamentMatch;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MatchParticipant extends Component
{
    use AuthorizesRequests;
    use WithRateLimiting;

    public $match;
    public $tournament;
    public $loggedUser;

    public function mount(TournamentMatch $match)
    {
        $match->load(['round.stage']);
        $this->match = $match;

        $this->tournament = app('tournament');
        $this->loggedUser = app('loggedUser');
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

        if (!$this->match->ffaParticipants->contains($team)) {
            $this->match->ffaParticipants()->attach($team);

            createToast('success', '', __('Added'));
        } else {
            createToast('error', '', __('Withdraw before joining another lobby'));
        }

        return redirect(request()->header('Referer'));
    }

    public function leave()
    {
        try {
            $this->rateLimit(1, 10);

            $player = Auth::user();

            $this->authorize('withdrawTeamFromQualifierLobby', $this->match);

            $team = $player->teams()->firstWhere('tournament_id', $this->tournament->id);

            if ($this->match->ffaParticipants->contains($team)) {
                $this->match->ffaParticipants()->detach($team);

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
