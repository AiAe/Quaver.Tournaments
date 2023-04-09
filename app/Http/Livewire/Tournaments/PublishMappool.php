<?php

namespace App\Http\Livewire\Tournaments;

use App\Models\TournamentStageRound;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class PublishMappool extends Component
{
    use AuthorizesRequests;

    public $round;

    public function mount($round)
    {
        $this->round = $round;
    }

    public function publish()
    {
        $user = auth()->user();

        $user->can('updateMappool', $this->round);

        $round = TournamentStageRound::where('id', $this->round->id)->firstOrFail();
        $round->mappool_visible = !$round->mappool_visible;
        $round->save();

        $this->round = $round;
    }

    public function render()
    {
        return view('livewire.tournaments.publish-mappool');
    }
}
