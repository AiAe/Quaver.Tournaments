<?php

namespace App\Providers;

use App\Http\Middleware\Authenticated;
use App\Http\Middleware\Tournament;
use App\Models\User;
use App\Observers\UserObserver;
use App\Providers\Socialite\DiscordSocialiteProvider;
use App\Providers\Socialite\QuaverSocialiteProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Contracts\Factory;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Livewire::addPersistentMiddleware([
            Authenticated::class,
            Tournament::class
        ]);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        if (config('app.env') == "local") {
//            Model::preventLazyLoading();
//        }

        if (config('app.env') == 'production') {
            \URL::forceScheme('https');
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
