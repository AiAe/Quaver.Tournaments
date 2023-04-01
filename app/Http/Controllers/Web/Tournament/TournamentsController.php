<?php

namespace App\Http\Controllers\Web\Tournament;

use App\Http\Controllers\Controller;
use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class TournamentsController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Tournament::class, 'tournament');
    }

    public function index()
    {
        return view('web.tournaments.index', [
            'SEOData' => new SEOData(
                title: 'Tournaments',
                description: 'Find the perfect tournaments for you.',
            ),
        ]);
    }

    public function show(Tournament $tournament)
    {
        $tournament->load('metas');

        return view('web.tournaments.show', compact('tournament'));
    }

    public function edit(Tournament $tournament)
    {
        $this->authorize('update', $tournament);
        $tournament->load('metas');

        return view('web.tournaments.edit', compact('tournament'));
    }

    public function update(Request $request, Tournament $tournament)
    {
        $this->authorize('update', $tournament);

        if ($request->has('status')) {
            $validator = Validator::make($request->all(), [
                'status' => ['required', 'numeric']
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'prize' => ['nullable', 'array'],
                'rank' => ['nullable', 'array'],
                'register' => ['nullable', 'array'],
                'discord' => ['nullable'],
                'twitch' => ['nullable'],
                'spreadsheet' => ['nullable'],
                'information' => ['nullable'],
            ]);
        }

        $validator->validate();
        $validated = $validator->validated();

        // Handle tournament status post form
        if ($request->has('status')) {
            $tournament->status = $validated['status'];
            $tournament->save();

            createToast('success', '', __('Tournament status has been changed!'));

            return back();
        }

        foreach ($validated as $key => $value) {
            $tournament->setMeta($key, $value);
        }

        $tournament->saveMeta();

        return back();
    }

    public function destroy(Tournament $tournament)
    {
        $this->authorize('delete', $tournament);

        $tournament->delete();

        return redirect(route('web.tournaments.index'));
    }

    public function mappools(Tournament $tournament)
    {
        return view('web.tournaments.mappools', ['tournament' => $tournament]);
    }

    public function schedules(Tournament $tournament)
    {
        // TODO: eager load staff once implemented
        $tournament->load(['stages.rounds.matches.team1', 'stages.rounds.matches.team2']);
        return view('web.tournaments.schedules', ['tournament' => $tournament]);
    }
}
