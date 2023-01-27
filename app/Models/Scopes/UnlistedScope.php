<?php

namespace App\Models\Scopes;

use App\Enums\TournamentStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class UnlistedScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $canViewUnlisted = auth()->user()?->can('viewUnlisted', $model);

        if (!$canViewUnlisted) {
            $builder->whereNot('status', TournamentStatus::Unlisted);
        }
    }
}
