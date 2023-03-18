<?php

namespace App\Http\Controllers\Web\Tournament;

use App\Http\Controllers\Controller;
use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TournamentRulesController extends Controller
{
    public function show(Tournament $tournament)
    {
        $title = __('Rules');

        return view('web.tournaments.rules', compact('tournament', 'title'));
    }

    public function update(Request $request, Tournament $tournament)
    {
        $this->authorize('update', $tournament);

        $validator = Validator::make($request->all(), [
            'rules' => ['nullable', 'string', 'max:8000']
        ]);

        $validator->validate();
        $validated = $validator->validated();

        $tournament->setMeta('rules', $validated['rules'] ?? "");
        $tournament->saveMeta();

        return redirect(request()->header('Referer'));
    }
}
