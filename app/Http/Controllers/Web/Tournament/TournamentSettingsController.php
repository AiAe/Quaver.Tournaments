<?php

namespace App\Http\Controllers\Web\Tournament;

use App\Http\Controllers\Controller;
use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TournamentSettingsController extends Controller
{
    public function show(Tournament $tournament)
    {
        $this->authorize('update', $tournament);

        $title = __('Tournament Settings');

        return view('web.tournament.settings', compact('tournament', 'title'));
    }

    public function update(Request $request, Tournament $tournament)
    {
        $this->authorize('update', $tournament);

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'min:3', 'max:30', 'regex:/^[A-Za-z0-9\s\_\-]+$/']
        ]);

        $validator->validate();
        $validated = $validator->validated();

        $tournament->fill($validated);
        $tournament->save();

        createToast('success', null, __('Settings are updated!'));

        return back();
    }
}
