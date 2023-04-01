<?php

namespace App\Http\Controllers\Web\Tournament;

use App\Http\Controllers\Controller;
use App\Models\Tournament;
use App\Models\TournamentStage;
use App\Models\TournamentStageRound;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TournamentRoundController extends Controller
{

    public function store(Request $request, Tournament $tournament)
    {
        $this->authorize('update', $tournament);

        $validator = Validator::make($request->all(), [
            'tournament_stage_id' => ['required'],
            'name' => ['required'],
            'starts_at' => ['required'],
            'ends_at' => ['required'],
            'round_text' => ['nullable'],
        ]);

        $validator->validate();
        $validated = $validator->validated();

        $tournament_stage = TournamentStage::where('tournament_id', $tournament->id)
            ->where('id', $validated['tournament_stage_id'])
            ->withTrashed()
            ->firstOrFail();

        // Get last round index
        $last_round = TournamentStageRound::where('tournament_stage_id', $tournament_stage->id)
            ->withTrashed()
            ->orderByDesc('id')
            ->first();

        if($last_round) {
            $validated['index'] = $last_round->index + 1;
        } else {
            $validated['index'] = 0;
        }

        $stage = new TournamentStageRound();
        $stage->fill($validated);
        $stage->save();

        createToast('success', null, __('Round was created successfully!'));

        return back();
    }

    public function show(Tournament $tournament, TournamentStageRound $round)
    {
        // TODO: eager load staff for schedule once implemented
        $round->load('matches', 'maps.map');
        return view('web.tournaments.rounds.show', [
            'tournament' => $tournament,
            'round' => $round,
        ]);
    }

    public function edit(TournamentStageRound $round)
    {
    }

    public function update(Request $request, TournamentStageRound $round)
    {
    }

    public function destroy(Tournament $tournament, TournamentStageRound $round)
    {
        $this->authorize('delete', $tournament);

        $tournament_stage = TournamentStage::where('id', $round->tournament_stage_id)->firstOrFail();

        $round->delete();

        createToast('success', '', __('Round is deleted!'));

        return redirect(route('web.tournaments.stages.index', [$tournament, $tournament_stage]));
    }
}
