<?php

namespace App\Notifications;

use App\Models\Tournament;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class TeamInvite extends Notification
{
    use Queueable;

    private User $user;
    private Tournament $tournament;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $tournament)
    {
        $this->user = $user;
        $this->tournament = $tournament;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'sender' => [
                'id' => $notifiable->id,
                'username' => $notifiable->username
            ],
            'tournament_id' => $this->tournament->id,
        ];
    }
}
