<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    protected $providers = [
        'discord', 'quaver'
    ];

    public function redirectToProvider(Request $request, $driver)
    {
        // If `redirect` is provided in route it will save and will redirect back to it
        if($request->has('redirect')) {
            session()->put('auth_redirect', $request->get('redirect'));
        }

        if (!$this->isProviderAllowed($driver)) {
            return $this->sendFailedResponse("{$driver} is not currently supported");
        }

        if (Auth::user() && !empty(Auth::user()->discord_user_id)) {
            return $this->sendFailedResponse(__("You are already logged in!"));
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

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        createToast('success', '', __('Logged out successfully!'));

        // Redirect back to specific route if provided
        if($request->has('redirect')) {
            return redirect($request->get('redirect'));
        }

        return redirect(route('web.home'));
    }

    // Protected

    protected function sendFailedResponse($msg = null)
    {
        createToast('error', '', $msg);
        return redirect(route('web.home'));
    }

    protected function loginOrCreateQuaverAccount($providerUser)
    {
        $user = User::where('quaver_user_id', $providerUser->quaver_user_id)->first();

        if (empty($user)) {
            $user = User::create([
                'quaver_user_id' => $providerUser->quaver_user_id,
                'username' => $providerUser->quaver_username,
                'country' => "XX"
            ]);
        }

        Auth::login($user, true);

        // Redirect back to auth route if it's provided in session
        if($auth_redirect = session('auth_redirect')) {
            return redirect($auth_redirect);
        }

        return redirect(route('web.home'));
    }

    protected function loginOrCreateDiscordAccount($providerUser)
    {
        if (!Auth::user()) {
            return redirect(route('web.home'));
        }

        $user = User::where('quaver_user_id', Auth::user()->quaver_user_id)->first();

        if (!empty($user)) {
            $user->update([
                'discord_user_id' => $providerUser->discord_user_id
            ]);
        }

        createToast('success', '', __('Successfully connected your Discord!'));

        // Redirect back to auth route if it's provided in session
        if($auth_redirect = session('auth_redirect')) {
            return redirect($auth_redirect);
        }

        return redirect(route('web.home'));
    }

    // Private functions

    private function isProviderAllowed($driver)
    {
        return in_array($driver, $this->providers) && config()->has("services.{$driver}");
    }
}
