<?php

namespace App\Notifications;

use App\Models\Team;
use App\Models\Tournament;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class TeamInvite extends Notification
{
    use Queueable;

    private User $user;
    private Tournament $tournament;
    private Team $team;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $tournament, $team)
    {
        $this->user = $user;
        $this->tournament = $tournament;
        $this->team = $team;
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
                'id' => $this->user->id,
                'username' => $this->user->username
            ],
            'tournament' => [
                'id' => $this->tournament->id,
                'slug' => $this->tournament->slug,
                'name' => $this->tournament->name
            ],
            'team' => [
                'id' => $this->team->id,
                'slug' => $this->team->slug,
                'name' => $this->team->name,
            ]
        ];
    }
}
