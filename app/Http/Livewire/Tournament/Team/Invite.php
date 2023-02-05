<?php

namespace App\Http\Livewire\Tournament\Team;

use App\Models\Tournament;
use App\Models\User;
use App\Notifications\TeamInvite;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Invite extends Component
{
    use AuthorizesRequests;

    public $tournament_id;
    public $team_id;
    public $username;

    protected function rules()
    {
        if ($player = User::select(['id'])->where('username', $this->username)->first()) {
            return [
                'username' => [
                    'required',
                    'min:3',
                    'max:15',
                    function ($attributes, $value, $fail) use ($player) {
                        if ($player->teams()->where('team_id', $this->team_id)->exists()) {
                            $fail(__('Player is already in the team!'));
                        }
                    },
                    function ($attributes, $value, $fail) use ($player) {
                        if ($player->invites()->where('team_id', $this->team_id)->exists()) {
                            $fail(__('Player has been invited already!'));
                        }
                    },
                ]
            ];
        }

        return [
            'username' => ['required', Rule::exists('users', 'username'), 'min:3', 'max:15']
        ];
    }

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
                $player->notify(new TeamInvite($user, $tournament, $team));

                createToast('success', '', __('Invitation was sent!'));
            } else {
                createToast('error', '', __('Team not found!'), false);
            }
        } else {
            createToast('error', '', __('Player not found!'), false);
        }

        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('livewire.tournament.team.invite');
    }
}
