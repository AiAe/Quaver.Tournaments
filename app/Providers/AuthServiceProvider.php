<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Team;
use App\Models\Tournament;
use App\Models\TournamentMatch;
use App\Policies\MatchPolicy;
use App\Policies\TeamPolicy;
use App\Policies\TournamentPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Tournament::class => TournamentPolicy::class,
        Team::class => TeamPolicy::class,
        TournamentMatch::class => MatchPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

//        Gate::before(function (User $user, string $ability) {
//            if ($user->hasRole(UserRoles::Admin)) {
//                return true;
//            }
//
//            return null;
//        });
    }
}
