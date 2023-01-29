<?php

namespace App\Http\Livewire\Tournament\Team;

use App\Models\Tournament;
use App\Models\User;
use App\Notifications\TeamInvite;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Invite extends Component
{
    use AuthorizesRequests;

    public $tournament_id;
    public $username;

    protected $rules = [
        // Maybe create custom rule to verify Player exists?
        // Also we probably should update player's username constantly to not have duplicates
        // Since we search for player by username and take first result?
        // Alternatively we add select2 with api search for players
        'username' => ['required', 'min:3', 'max:15']
    ];

    public function mount($tournament_id)
    {
        $this->tournament_id = $tournament_id;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function create()
    {
        // ToDo probably another ability?
        $this->authorize('invite', Tournament::class);
        $validated = $this->validate();

        // Check if user exists
        $player = User::where('username', $validated['username'])->first();

        if ($player) {
            $user = auth()->user();
            $tournament = Tournament::where('id', $this->tournament_id)->first();
            $team = $user->teams()->firstWhere('tournament_id', $this->tournament_id);

            if ($tournament && $team) {
                $team->invites()->attach($player);
                $player->notify(new TeamInvite($user, $tournament));

                session()->flash('invite-success', __('Successfully invited player!'));
            } else {
                session()->flash('invite-team-not-found', __('Team not found!'));
            }
        } else {
            session()->flash('invite-player-not-found', __('Player not found!'));
        }
    }

    public function render()
    {
        return view('livewire.tournament.team.invite');
    }
}
