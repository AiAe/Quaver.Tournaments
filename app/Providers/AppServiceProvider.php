<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\UserObserver;
use App\Providers\Socialite\DiscordSocialiteProvider;
use App\Providers\Socialite\QuaverSocialiteProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Contracts\Factory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (config('app.env') == "local") {
            Model::preventLazyLoading();
        }

        // Change paginator style to Bootstrap 5
        Paginator::useBootstrapFive();

        User::observe(UserObserver::class);

        $socialite = $this->app->make(Factory::class);

        $socialite->extend('quaver', function () use ($socialite) {
            $config = config('services.quaver');

            return $socialite->buildProvider(QuaverSocialiteProvider::class, $config);
        });

        $socialite->extend('discord', function () use ($socialite) {
            $config = config('services.discord');

            return $socialite->buildProvider(DiscordSocialiteProvider::class, $config);
        });

        Http::macro('quaver', function () {
            return Http::baseUrl('https://api.quavergame.com/v1');
        });
    }
}
