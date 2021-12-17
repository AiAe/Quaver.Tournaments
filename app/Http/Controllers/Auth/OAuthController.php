<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class OAuthController extends Controller
{
    public function __construct()
    {
    }

    protected $providers = [
        'discord', 'quaver'
    ];

    public function redirectToProvider($driver)
    {
        if (!$this->isProviderAllowed($driver)) {
            return $this->sendFailedResponse("{$driver} is not currently supported");
        }

        try {
            return Socialite::driver($driver)->redirect();
        } catch (Exception $e) {
            dd($e);
            return $this->sendFailedResponse($e->getMessage());
        }
    }


    public function handleProviderCallback($driver)
    {
        try {
            $user = Socialite::driver($driver)->stateless()->user();
        } catch (Exception $e) {
            return $this->sendFailedResponse($e->getMessage());
        }

        if($user->quaver_user_id??null) {
            $this->loginOrCreateQuaverAccount($user);
        } elseif($user->discord_user_id??null) {
            $this->loginOrCreateDiscordAccount($user);
        }

        return $this->sendFailedResponse("No email id returned from {$driver} provider.");
    }

    protected function sendFailedResponse($msg = null)
    {
        return redirect(route('home'));
    }

    protected function loginOrCreateQuaverAccount($providerUser)
    {
        $user = User::where('quaver_user_id', $providerUser->quaver_user_id)->first();

        if (empty($user)) {
            $user = User::create([
                'quaver_user_id' => $providerUser->quaver_user_id,
                'quaver_username' => $providerUser->quaver_username
            ]);
        }

        Auth::login($user, true);

        return redirect(route('home'));
    }

    protected function loginOrCreateDiscordAccount($providerUser)
    {
        if(!Auth::user()) {
            return redirect(route('home'));
        }

        $user = User::where('quaver_user_id', Auth::user()->quaver_user_id)->first();

        if (empty($user)) {
            return redirect(route('home'));
        } else {
            $user->update([
                'discord_user_id' => $providerUser->discord_user_id,
                'discord_username' => $providerUser->discord_username
            ]);
        }

        return redirect(route('home'));
    }

    private function isProviderAllowed($driver)
    {
        return in_array($driver, $this->providers) && config()->has("services.{$driver}");
    }
}
