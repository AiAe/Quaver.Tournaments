<?php

namespace App\Http\Controllers\Web\Tournament;

use App\Http\Controllers\Controller;
use App\Models\Tournament;
use App\Models\TournamentStaff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades;
use Illuminate\Validation\Validator;

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

        $validator = Facades\Validator::make($request->all(), [
            'username' => ['required', 'exists:App\Models\User,username'],
            'role' => ['required'],
        ]);

        $validator->after(function (Validator $validator) use ($tournament, $request) {
            $user = User::select(['id'])->where('username', $request['username'])->first();

            if ($tournament->staff()
                ->where('user_id', $user->id)
                ->where('staff_role', $request['role'])
                ->exists()
            ) {
                $validator->errors()->add('role', 'User with that role already added!');
            }
        });

        $validator->validate();
        $validated = $validator->validated();

        $user = User::select(['id'])->where('username', $validated['username'])->first();
        $tournament->staff()->create(['user_id' => $user->id, 'staff_role' => $validated['role']]);
        createToast('success', '', __('Staff has been added!'));

        return back();
    }

    public function destroy(Tournament $tournament, TournamentStaff $staff)
    {
        // Probably change to current user policy?
        $this->authorize('delete', $tournament);

        $staff->delete();

        createToast('success', '', __('Staff member was removed!'));
        return back();
    }
}
