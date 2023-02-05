<?php

namespace App\Http\Livewire\User;

use App\Models\Team;
use App\Models\User;
use App\Notifications\TeamInvite;
use Livewire\Component;

class Notification extends Component
{
    public $notification;

    public function mount($notification)
    {
        $this->notification = $notification;
    }

    public function open()
    {
        // Handle normal notifications
    }

    public function accept()
    {
        if ($this->notification['type'] == TeamInvite::class) {
            $player = User::where('id', $this->notification['notifiable_id'])->firstOrFail();
            $team = Team::where('id', $this->notification['data']['team']['id'])->firstOrFail();

            $team->members()->attach($player);
            $team->invites()->detach($player);
            $this->notification->markAsRead();

            return redirect(route('web.tournaments.teams.show', [
                'tournament' => $this->notification['data']['tournament']['slug'],
                'team' => $this->notification['data']['team']['slug']
            ]))->with('success', __('You joined the team!'));
        }
    }

    public function decline()
    {
        if ($this->notification['type'] == TeamInvite::class) {
            $player = User::where('id', $this->notification['notifiable_id'])->firstOrFail();
            $team = Team::where('id', $this->notification['data']['team']['id'])->firstOrFail();

            $team->invites()->detach($player);
            $this->notification->markAsRead();

            return redirect(request()->header('Referer'));
        }
    }

    public function render()
    {
        return view('livewire.user.notification');
    }
}
