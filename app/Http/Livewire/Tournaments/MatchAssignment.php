<?php

namespace App\Http\Livewire\Tournaments;

use App\Enums\StaffRole;
use App\Models\TournamentMatch;
use App\Models\TournamentMatchStaff;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class MatchAssignment extends Component
{
    use AuthorizesRequests;

    public $match;
    public $tournament;
    public $loggedUser;

    public $user_id;

    public function mount(TournamentMatch $match)
    {
//        $match->load(['round']);
        $this->match = $match;

        $this->tournament = app('tournament');
        $this->loggedUser = app('loggedUser');

        $this->user_id = $this->loggedUser->id;
    }

    public function referee()
    {
        $this->authorize('editStaff', $this->match);

        // Check if the spot is free
        $empty_spot = TournamentMatchStaff::query()
            ->where('tournament_match_id', $this->match->id)
            ->where('role', '=', StaffRole::Referee)
            ->first();

        if ($this->tournament->userIsHeadReferee($this->loggedUser) && $empty_spot) {
            // Remove staff member
            $empty_spot->delete();
            $empty_spot = null;
        }

        if (!$empty_spot) {
            TournamentMatchStaff::create([
                'tournament_match_id' => $this->match->id,
                'user_id' => $this->user_id,
                'role' => StaffRole::Referee
            ]);

            $this->toast_success();
        } else {
            $this->toast_error();
        }

        return redirect(request()->header('Referer'));
    }

    public function streamer()
    {
        $this->authorize('editStaff', $this->match);

        // Check if the spot is free
//        $empty_spot = TournamentMatchStaff::query()
//            ->where('tournament_match_id', $this->match->id)
//            ->where('role', '=', StaffRole::Streamer)
//            ->first();
//
//        if ($this->tournament->userIsHeadStreamer($this->loggedUser) && $empty_spot) {
//            // Remove staff member
//            $empty_spot->delete();
//            $empty_spot = null;
//        }
//
//        if (!$empty_spot) {
//            TournamentMatchStaff::create([
//                'tournament_match_id' => $this->match->id,
//                'user_id' => $this->user_id,
//                'role' => StaffRole::Streamer
//            ]);
//
//            $this->toast_success();
//        } else {
//            $this->toast_error();
//        }

        return redirect(request()->header('Referer'));
    }

    public function commentator()
    {
        $this->authorize('editStaff', $this->match);

        // ToDo handle multiple commentators

        return redirect(request()->header('Referer'));
    }

    private function toast_success()
    {
        createToast('success', '', __('Successfully assigned to this lobby!'));
    }

    private function toast_error()
    {
        createToast('error', '', __('Spot is already taken!'));
    }
}
