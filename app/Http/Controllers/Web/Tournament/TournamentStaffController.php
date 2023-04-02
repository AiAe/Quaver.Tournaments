<?php

namespace App\Http\Controllers\Web\Tournament;

use App\Http\Controllers\Controller;
use App\Models\Tournament;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $staff = $tournament->staff()->wherePivot('user_id', $user->id)->first();

        if ($staff) {
            // Update
            createToast('success', '', __('Player has been updated!'));

            $staff->pivot->staff_role = $validated['role'];
            $staff->pivot->save();
        } else {
            // Create
            $tournament->staff()->attach($user, ['staff_role' => $validated['role']]);
            createToast('success', '', __('Player has been added!'));
        }
        return back();
    }

    public function destroy(Tournament $tournament, User $staff)
    {
        // Probably change to current user policy?
        $this->authorize('delete', $tournament);

        $tournament->staff()->detach($staff);

        createToast('success', '', __('Staff member was removed!'));
        return back();
    }
}
