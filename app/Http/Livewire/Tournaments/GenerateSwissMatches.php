<?php

namespace App\Http\Livewire\Tournaments;

use App\Helpers\MatchGenerator;
use App\Models\Tournament;
use App\Models\TournamentStageRound;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class GenerateSwissMatches extends Component
{
    use AuthorizesRequests;

    public $tournament;
    public $round;
    public $label;
    public $csv;

    public function mount(Tournament $tournament, TournamentStageRound $round)
    {
        $this->tournament = $tournament;
        $this->round = $round;
    }

    public function import()
    {
        if($this->csv) {
            $matches = [];

            $split_contents = explode("\n", $this->csv);

            foreach ($split_contents as $line) {
                $teams = explode("\t", $line);

                $matches[] = $teams;
            }

            MatchGenerator::generateMatchesFromMatchUps($this->round, $matches, $this->label);
        }

        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('livewire.tournaments.generate-swiss-matches');
    }
}
