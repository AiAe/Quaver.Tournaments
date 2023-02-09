<?php

namespace App\Http\Livewire\Tournament\Team;

use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class PlayerActions extends Component
{
    use AuthorizesRequests;

    public $team;
    public $user;

    public function mount(Team $team, User $user)
    {
        $this->team = $team;
        $this->user = $user;
    }

    public function remove()
    {
        $this->authorize('update', $this->team);

        if (!$this->team->captain()->is($this->user)) {
            $this->team->invites()->detach($this->user);
            $this->team->members()->detach($this->user);

            createToast('success', '', __('Player was removed!'));
        } else {
            createToast('success', '', __('You cannot remove yourself!'));
        }

        return redirect(request()->header('Referer'));
    }

    public function change_captain()
    {
        $this->authorize('update', $this->team);

        $current_captain = $this->team->captain();

        if (!$current_captain->is($this->user)) {
            $this->team->members()->updateExistingPivot($this->team->captain(), ['is_captain' => false]);
            $this->team->members()->updateExistingPivot($this->user, ['is_captain' => true]);

            createToast('success', '', __(':user is now the captain!', ['user' => $this->user->username]));
        } else {
            createToast('success', '', __('Your already captain!'));
        }

        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('livewire.tournament.team.player-actions');
    }
}
