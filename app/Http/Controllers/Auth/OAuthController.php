<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
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

        if (Auth::user() && !empty(Auth::user()->discord_user_id)) {
            return $this->sendFailedResponse("You are already logged in!");
        }

        try {
            return Socialite::driver($driver)->redirect();
        } catch (Exception $e) {
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

        if ($user->quaver_user_id ?? null) {
            return $this->loginOrCreateQuaverAccount($user);
        }

        if ($user->discord_user_id ?? null) {
            return $this->loginOrCreateDiscordAccount($user);
        }

        return $this->sendFailedResponse("No user returned from {$driver} provider.");
    }

    protected function sendFailedResponse($msg = null)
    {
        return redirect(route('home'))->with('error', $msg);
    }

    protected function loginOrCreateQuaverAccount($providerUser)
    {
        $user = User::where('quaver_user_id', $providerUser->quaver_user_id)->first();

        if (empty($user)) {
            $user = User::create([
                'quaver_user_id' => $providerUser->quaver_user_id,
                'quaver_username' => $providerUser->quaver_username,
                'quaver_avatar' => $providerUser->quaver_avatar
            ]);
        }

        Auth::login($user, true);

        if (empty($user->discord_user_id)) {
            return redirect(route('oauth', 'discord'));
        }

        return redirect(route('home'));
    }

    protected function loginOrCreateDiscordAccount($providerUser)
    {
        if (!Auth::user()) {
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

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('home'))->with(['success' => __('Logged out successfully!')]);
    }
}
