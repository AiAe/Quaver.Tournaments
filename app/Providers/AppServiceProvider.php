<?php

namespace App\Providers;

use App\Providers\Socialite\DiscordSocialiteProvider;
use App\Providers\Socialite\QuaverSocialiteProvider;
use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrap();

        $socialite = $this->app->make(Factory::class);

        $socialite->extend('quaver', function () use ($socialite) {
            $config = config('services.quaver');

            return $socialite->buildProvider(QuaverSocialiteProvider::class, $config);
        });

        $socialite->extend('discord', function () use ($socialite) {
            $config = config('services.discord');

            return $socialite->buildProvider(DiscordSocialiteProvider::class, $config);
        });
    }
}
