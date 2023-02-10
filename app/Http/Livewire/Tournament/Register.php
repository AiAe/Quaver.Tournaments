<?php

namespace App\Http\Livewire\Tournament;

use App\Enums\TournamentFormat;
use App\Models\Team;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Str;

class Register extends Component
{
    use AuthorizesRequests;

    public $tournament;
    public $name;
    public $slug;

    protected function rules()
    {
        $slug_rule = Rule::unique('teams')->where('tournament_id', $this->tournament->id);

        if ($this->tournament->format == TournamentFormat::Team) {
            return [
                'name' => ['required', 'min:3', 'max:30', 'regex:/^[A-Za-z0-9\s\_\-]+$/'],
                'slug' => ['required', $slug_rule, 'min:3', 'max:30', 'regex:/^[A-Za-z0-9\-\_]+$/']
            ];
        }

        return [
            'name' => ['nullable'],
            'slug' => ['nullable', $slug_rule]
        ];
    }

    public function mount($tournament)
    {
        $this->tournament = $tournament;
    }

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
        $this->authorize('create', [Team::class, $this->tournament]);

        $validated = $this->validate();

        $user = auth()->user();

        if (!isset($validated['name']) || $validated['name'] == "") {
            $validated['name'] = $user->username;
            $validated['slug'] = Str::slug($user->username);
        }

        if (!$this->slug) {
            $this->slug = $validated['slug'];
        }

        $validated['tournament_id'] = $this->tournament->id;

        $team = Team::create($validated);
        $team->members()->attach($user, ['is_captain' => true]);

        createToast('success', '', __('You signed up successfully!'));

        return redirect()->to(route('web.tournaments.teams.show',
            ['tournament' => $this->tournament->slug, 'team' => $this->slug]));
    }

    public function render()
    {
        return view('livewire.tournament.register');
    }
}
