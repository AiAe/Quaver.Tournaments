<?php

namespace App\Http\Controllers\Web\User;

use App\Enums\TournamentFormat;
use App\Enums\TournamentStatus;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function show(User $user)
    {
        // User profile
    }

    public function edit(Request $request)
    {
        $this->authorize('update', app('loggedUser'));

        return view('web.user.edit');
    }

    public function update(Request $request)
    {
        $loggedUser = app('loggedUser');
        $this->authorize('update', $loggedUser);

        $validator = Validator::make($request->all(), [
            'timezone_offset' => ['required', 'numeric', 'between:-12,14']
        ]);

        $validator->validate();
        $validated = $validator->validated();

        $loggedUser->fill($validated);
        $loggedUser->save();

        // Update all solo tournaments
        $this->dispatch(function () use ($loggedUser) {
            $tournaments = $loggedUser->participatedTournaments()
                ->where('status', '!=', TournamentStatus::Concluded)
                ->where('format', TournamentFormat::Solo);

            foreach ($tournaments as $tournament) {
                $team = $loggedUser->teams()->firstWhere('tournament_id', $tournament->id);
                $team->timezone_offset = $loggedUser->timezone_offset;
                $team->save();
            }
        });

        createToast('success', '', __('Settings are saved successfully!'));

        return back();
    }
}
