<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Enums\UserRoles;
use App\Models\Team;
use App\Models\Tournament;
use App\Models\User;
use App\Policies\TeamPolicy;
use App\Policies\TournamentPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Tournament::class => TournamentPolicy::class,
        Team::class => TeamPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        
        Gate::before(function (User $user, string $ability) {
            if ($user->hasRole(UserRoles::Admin)) {
                return true;
            }

            return null;
        });
    }
}
