<?php

namespace App\Http\Controllers\Web\Tournament;

use App\Http\Controllers\Controller;
use App\Models\Tournament;
use App\Models\TournamentStage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TournamentStageController extends Controller
{
    public function index(Tournament $tournament)
    {
        $tournament->load('stages.rounds');
        return view('web.tournaments.stages.index', ['title' => 'Stages', 'tournament' => $tournament]);
    }

    public function store(Request $request, Tournament $tournament)
    {
        $this->authorize('update', $tournament);

        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'stage_format' => ['required', 'numeric'],
            'stage_text' => ['nullable']
        ]);

        $validator->validate();
        $validated = $validator->validated();

        $validated['tournament_id'] = $tournament->id;

        // Get last stage index
        $last_stage = TournamentStage::where('tournament_id', $tournament->id)
            ->withTrashed()
            ->orderByDesc('id')->first();

        if($last_stage) {
            $validated['index'] = $last_stage->index + 1;
        } else {
            $validated['index'] = 0;
        }

        $stage = new TournamentStage();
        $stage->fill($validated);
        $stage->save();

        createToast('success', null, __('Stage was created successfully!'));

        return back();
    }

//    public function show(TournamentStage $tournamentStage)
//    {
//    }

    public function edit(TournamentStage $stage)
    {
    }

    public function update(Request $request, TournamentStage $stage)
    {
    }

    public function destroy(Tournament $tournament, TournamentStage $stage)
    {
        $this->authorize('delete', $tournament);

        $stage->delete();

        createToast('success', '', __('Stage is deleted!'));

        return back();
    }
}
