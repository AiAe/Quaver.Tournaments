<?php

namespace App\Http\Livewire\Tournaments;

use App\Http\QuaverApi\QuaverApi;
use App\Models\QuaverMap;
use App\Models\TournamentStageRoundMap;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class UpdateMappool extends Component
{
    use AuthorizesRequests;

    public $tournament;
    public $tournament_stage_round;
    public $quaver_map_url;
    public $quaver_map_id;
    public $category;
    public $sub_category;
    public $mods = null;
    public $offset = 0;
    public $modded_difficulty = null;
    public $modded_bpm = null;

    protected function rules()
    {
        return [
            'quaver_map_url' => ['required', 'string'],
            'quaver_map_id' => ['required', 'numeric'],
            'category' => ['required', 'string', 'max:255'],
            'sub_category' => ['required', 'string', 'max:255'],
            'mods' => ['nullable', 'string', 'max:255'],
            'offset' => ['required', 'numeric', 'numeric', 'min:-1000', 'max:1000'],
            'modded_difficulty' => ['nullable', 'numeric', 'min:1', 'max:1000'],
            'modded_bpm' => ['nullable', 'numeric', 'min:1', 'max:1000']
        ];
    }

    public function mount($tournament, $tournament_stage_round)
    {
        $this->tournament = $tournament;
        $this->tournament_stage_round = $tournament_stage_round;
    }

    public function fetch_map()
    {
        $id = (int)basename($this->quaver_map_url);

        if (!$id) {
            $this->addError('map_not_found', __('Invalid map url!'));
            return;
        }

        try {
            $api_map = QuaverApi::getMap($id);

            if (!$api_map) {
                $this->addError('map_not_found', __('Map is not found!'));
                return;
            }

            $map = QuaverMap::where('quaver_map_id', $id)->first();

            if (!$map) {
                $map = QuaverMap::create(QuaverMap::quaverDataToAttributes($api_map));
            }

            $this->quaver_map_id = $map->quaver_map_id;
        } catch (\Exception $e) {
            $this->addError('map_not_found', __('Failed to fetch map!'));
        }
    }

    public function create()
    {
        $user = auth()->user();

        $user->can('updateMappool', $this->tournament_stage_round);

        $validated = $this->validate();

        $validated['tournament_stage_round_id'] = $this->tournament_stage_round['id'];
        $validated['index'] = 0;

        $map = new TournamentStageRoundMap();
        $map->fill($validated);
        $map->save();

        createToast('success', '', __('Map is added successfully!'));

        return redirect()->to(route('web.tournaments.mappools',
            ['tournament' => $this->tournament->slug]));
    }

    public function render()
    {
        return view('livewire.tournaments.update-mappool');
    }
}
