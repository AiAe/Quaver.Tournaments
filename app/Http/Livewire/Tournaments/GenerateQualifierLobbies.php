<?php

namespace App\Http\Livewire\Tournaments;

use App\Helpers\MatchGenerator;
use App\Models\Tournament;
use App\Models\TournamentStageRound;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class GenerateQualifierLobbies extends Component
{
    use AuthorizesRequests;

    public $tournament;
    public $round;
    public $timestamps = [];
    public $i = 0;

    public function addTimestamp($i)
    {
        $i += 1;
        $this->i = $i;
        $this->timestamps[] = '';

        $this->emit('initDateTimePicker');
    }

    public function removeTimestamp($i)
    {
        unset($this->timestamps[$i]);
    }

    public function mount(Tournament $tournament, TournamentStageRound $round)
    {
        $this->tournament = $tournament;
        $this->round = $round;
    }

    public function generate()
    {
        foreach ($this->timestamps as &$timestamp) {
            $timestamp = Carbon::parse($timestamp);
        }

        MatchGenerator::generateQualifierLobbies($this->round, $this->timestamps);

        createToast('success', '', __('Qualifiers are generated successfully!'));

        return redirect()->to(route('web.tournaments.rounds.show',
            ['tournament' => $this->tournament->slug, 'round' => $this->round->id]));
    }

    public function render()
    {
        return view('livewire.tournaments.generate-qualifier-lobbies');
    }
}
