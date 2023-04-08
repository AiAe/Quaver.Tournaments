<?php

namespace App\Http\Livewire\Tournaments;

use App\Models\TournamentStageRoundMap;
use Livewire\Component;

class SortDeleteMappool extends Component
{
    public $tournament;
    public $tournament_stage_round;
    public $maps;

    public function updateMapOrder($orders)
    {
        foreach ($orders as $item) {
            TournamentStageRoundMap::where('id', $item['value'])->update([
                'index' => $item['order']
            ]);
        }

        $this->maps = TournamentStageRoundMap::with('map')
            ->where('tournament_stage_round_id', $this->tournament_stage_round->id)->get();
    }

    public function deleteMap($id)
    {
        $map = TournamentStageRoundMap::where('id', $id)->firstOrFail();
        $map->delete();

        createToast('success', '', __('Map is deleted successfully!'));

        return redirect()->to(route('web.tournaments.mappools',
            ['tournament' => $this->tournament->slug]));
    }

    public function render()
    {
        return view('livewire.tournaments.sort-delete-mappool');
    }
}
