<?php

namespace App\Http\Livewire\Tournaments;

use App\Enums\TournamentFormat;
use App\Models\Team;
use App\Models\Tournament;
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
    public $captcha;

    protected function rules()
    {
        $slug_rule = Rule::unique('teams')->where('tournament_id', $this->tournament->id);

        $captcha = $this->tournament->getMeta('register');
        $captcha_question = $captcha['question'] ?? null;
        $captcha_answer = $captcha['answer'] ?? null;

        $rules = [];

        if ($captcha_question && $captcha_answer) {
            $rules['captcha'] = ['required', function ($attributes, $value, $fail) use ($captcha_answer) {
                if (strtolower($value) !== strtolower($captcha_answer)) {
                    $fail(__('Answer is wrong!'));
                }
            },];
        }

        if ($this->tournament->format == TournamentFormat::Team) {
            $rules['name'] = ['required', 'min:3', 'max:30', 'regex:/^[A-Za-z0-9\s\_\-]+$/'];
            $rules['slug'] = ['required', $slug_rule, 'min:3', 'max:30', 'regex:/^[A-Za-z0-9\-\_]+$/'];
        } else {
            $rules['name'] = ['nullable'];
            $rules['slug'] = ['nullable', $slug_rule];
        }

        return $rules;
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
        return view('livewire.tournaments.register');
    }
}
