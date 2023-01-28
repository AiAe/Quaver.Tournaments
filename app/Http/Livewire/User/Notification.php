<?php

namespace App\Http\Livewire\User;

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
        switch ($this->notification['type']) {
            case TeamInvite::class:
                $user = User::where('id', $this->notification['notifiable_id'])->first();

                $notification = $user->notifications->where('id', $this->notification['id'])->first();
                $notification->markAsRead();

                return redirect(route('web.tournaments.show', $this->notification['data']['tournament_id']));
            default:
                return back();
        }
    }

    public function render()
    {
        return view('livewire.user.notification');
    }
}
