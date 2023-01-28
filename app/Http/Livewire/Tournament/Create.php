<?php

namespace App\Http\Livewire\Tournament;

use App\Enums\TournamentFormat;
use App\Enums\TournamentStatus;
use App\Models\Tournament;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Create extends Component
{
    use AuthorizesRequests;

    public $name;
    public $format = TournamentFormat::Solo->value;

    protected $rules = [
        'name' => ['required', 'min:3', 'max:30'],
        'format' => ['required']
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function create()
    {
        $this->authorize('create', Tournament::class);
        $validated = $this->validate();

        $user = auth()->user();

        $validated['user_id'] = $user->id;
        $validated['status'] = TournamentStatus::Unlisted->value;

        $tournament = Tournament::create($validated);

        return redirect()->to(route('web.tournaments.show', $tournament->id))->with('success', __('Tournament created!'));
    }

    public function render()
    {
        return view('livewire.tournament.create');
    }
}
