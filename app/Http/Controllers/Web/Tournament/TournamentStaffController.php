<?php

namespace App\Http\Controllers\Web\Tournament;

use App\Http\Controllers\Controller;
use App\Models\Tournament;
use App\Models\TournamentStaff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TournamentStaffController extends Controller
{
    public function index(Tournament $tournament)
    {
        $title = __('Staff');

        return view('web.tournaments.staff.index', ['title' => $title, 'tournament' => $tournament]);
    }

    public function create(Tournament $tournament)
    {
        $this->authorize('update', $tournament);

        $title = __('Invite Staff');

        return view('web.tournaments.staff.create', compact('title', 'tournament'));
    }

    public function store(Request $request, Tournament $tournament)
    {
        $this->authorize('update', $tournament);

        $validator = Validator::make($request->all(), [
            'username' => ['required', 'exists:App\Models\User,username'],
            'role' => ['required'],
        ]);

        $validator->validate();
        $validated = $validator->validated();

        $user = User::select(['id'])->where('username', $validated['username'])->first();

        $tournament_staff = TournamentStaff::where('tournament_id', $tournament->id)
            ->where('user_id', $user->id)->first();

        if ($tournament_staff) {
            // User already has that role
            createToast('success', '', __('Player has been updated!'));

            $tournament_staff->staff_role = $validated['role'];
            $tournament_staff->save();

            return back();
        } else {
            $staff = new TournamentStaff();
            $staff->tournament_id = $tournament->id;
            $staff->user_id = $user->id;
            $staff->staff_role = $validated['role'];
            $staff->save();
        }

        createToast('success', '', __('Player has been added!'));

        return back();
    }

    public function destroy(Tournament $tournament, $staff)
    {
        // Probably change to current user policy?
        $this->authorize('delete', $tournament);

        $staff = TournamentStaff::where('tournament_id', $tournament->id)
            ->where('user_id', $staff)->firstOrFail();

        $staff->delete();

        createToast('success', '', __('Staff member was removed!'));

        return back();
    }
}
