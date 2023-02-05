<?php

namespace App\Http\Livewire\Tournaments;

use App\Enums\TournamentFormat;
use App\Enums\TournamentStatus;
use App\Models\Tournament;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Str;

class Create extends Component
{
    use AuthorizesRequests;

    public $name;
    public $slug;
    public $format = TournamentFormat::Solo->value;

    protected $rules = [
        'name' => ['required', 'min:3', 'max:30'],
        'slug' => ['required', 'unique:App\Models\Tournament,slug', 'min:3', 'max:30'],
        'format' => ['required']
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function generate_slug()
    {
        $this->slug = Str::slug($this->name);
        $this->validate();
    }

    public function create()
    {
        $this->authorize('create', Tournament::class);
        $validated = $this->validate();

        $user = auth()->user();

        $validated['user_id'] = $user->id;
        $validated['status'] = TournamentStatus::Unlisted->value;

        $tournament = Tournament::create($validated);

        createToast('success', '', __('Tournament was created!'));

        return redirect()->to(route('web.tournaments.show', $tournament->slug));
    }

    public function render()
    {
        return view('livewire.tournaments.create');
    }
}
