<?php

namespace App\Observers;

use App\Models\Team;

class TeamObserver
{
    public function created(Team $team): void
    {
    }

    public function updated(Team $team): void
    {
        $team->updateTeamRank();
    }

    public function deleted(Team $team): void
    {
    }

    public function restored(Team $team): void
    {
    }

    public function forceDeleted(Team $team): void
    {
    }
}
