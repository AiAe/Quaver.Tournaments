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

            if (!$team->members()->where('user_id', $player->id)->exists()) {
                $team->members()->attach($player);
                $team->invites()->detach($player);
                $this->notification->markAsRead();

                createToast('success', '', __('You joined the team!'));

                return redirect(route('web.tournaments.teams.show', [
                    'tournament' => $this->notification['data']['tournament']['slug'],
                    'team' => $this->notification['data']['team']['slug']
                ]));
            } else {
                $team->invites()->detach($player);
                $this->notification->markAsRead();

                createToast('success', '', __('You are already in this team!'));

                return redirect(request()->header('Referer'));
            }
        }
    }

    public function decline()
    {
        if ($this->notification['type'] == TeamInvite::class) {
            $player = User::where('id', $this->notification['notifiable_id'])->firstOrFail();
            $team = Team::where('id', $this->notification['data']['team']['id'])->firstOrFail();

            $team->invites()->detach($player);
            $this->notification->markAsRead();

            createToast('success', '', __('You declined joining the team!'));

            return redirect(request()->header('Referer'));
        }
    }

    public function render()
    {
        return view('livewire.user.notification');
    }
}
