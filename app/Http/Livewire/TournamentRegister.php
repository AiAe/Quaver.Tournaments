<?php

namespace App\Http\Livewire;

use App\Enums\TournamentFormat;
use App\Models\Team;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class TournamentRegister extends Component
{
    use AuthorizesRequests;

    public $tournament;
    public $name;

    public function mount($tournament)
    {
        $this->tournament = $tournament;
    }

    public function create()
    {
        $this->authorize('create', Team::class);

        $rules = [
            'name' => ['nullable']
        ];

        if($this->tournament->format == TournamentFormat::Team) {
            $rules['name'] = ['required', 'min:3', 'max:30'];
        }

        $validated = $this->validate($rules);

        $user = auth()->user();

        if(!isset($validated['name']) || $validated['name'] == "") {
            $validated['name'] = $user->username;
        }

        $validated['user_id'] = $user->id;
        $validated['tournament_id'] = $this->tournament->id;

        $team = Team::create($validated);

        // ToDo redirect to team page inviting if its team

        return redirect()->to(route('web.tournaments.show', $this->tournament->id))
            ->with('success', __('Successfully registered!'));
    }

    public function render()
    {
        return view('livewire.tournament-register');
    }
}
