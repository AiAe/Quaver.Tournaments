<?php

namespace App\Jobs;

use App\Enums\UserRoles;
use App\Http\QuaverApi\QuaverApi;
use App\Models\User;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UserUpdateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

    public User $user;

    public function __construct(User $user)
    {
        $this->user = $user->withoutRelations();
    }

    public function handle(): void
    {
        try {
            $user_api = QuaverApi::getUserFull($this->user->quaver_user_id);

            if ($user_api) {
                $this->user->username = $user_api['info']['username'];
                $this->user->country = $user_api['info']['country'] ?? 'XX';
                $this->user->quaver_4k_rank = $user_api['keys4']['globalRank'];
                $this->user->quaver_7k_rank = $user_api['keys7']['globalRank'];
                $this->user->save();

                foreach ($this->user->teams as $team) {
                    $team->updateTeamRank();
                }
            }
        } catch (\Exception $e) {
            $this->user->roles()->create(['role' => UserRoles::Blacklisted]);
        }
    }
}
