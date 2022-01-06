<?php

namespace App\Http\Controllers\Signup;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\Player;
use App\Rules\StaffRoleValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class SignupController extends Controller
{
    private array $types = [
        'player',
        'staff'
    ];

    public function staff()
    {
        $pageData[] = "";
        $pageData['seo']['title'] = "Join Staff";

        return view('signup/staff', $pageData);
    }

    public function player()
    {
        $pageData[] = "";
        $pageData['seo']['title'] = "Join Tournament";

        $pageData['has_registered'] = Player::query()->where('user_id', Auth::user()->id)->exists();

        Redis::publish('discord', json_encode([
            "discord_id" => "108616029294301184",
            "discord_nick" => "AyyAyye"
        ]));

        return view('signup/player', $pageData);
    }

    private function verifyPlayer()
    {
        $player = Auth::user();
        $player->updateQuaverUsername();

        if (config('app.challonge_api'))
            $player->createChallongePlayer();

        if (config('app.discord_bot'))
            Redis::publish('discord', json_encode([
                "discord_id" => $player['discord_user_id'],
                "discord_nick" => $player['quaver_username']
            ]));
    }

    public function updatePlayer()
    {
        $is_registered = Player::query()->where('user_id', Auth::user()->id)->exists();

        if ($is_registered) {
            $this->verifyPlayer();
        }

        return back()->with('success', 'Successfully verified. If you still continue to have issue contact Organizators!');
    }

    public function save(Request $request)
    {
        $type = $request->route('type');
        $msg = null;
        $rules = [];

        if (!in_array($type, $this->types)) {
            return redirect(route('signupStaff'))->with('error', 'Form type not found!');
        }

        switch ($type) {
            case 'staff':
                $rules = [
                    'roles' => ["array", "min:1", "required", new StaffRoleValidation()],
                    'previous_experience' => 'required'
                ];
                $msg = 'You applied successfully!';
                break;
            case 'player':
                $rules = [
                    'timezone' => ["required", "numeric"]
                ];
                $msg = 'You registered successfully!';
                break;
        }

        $validator = Validator::make($request->all(), $rules);

        $validator->validate();
        $validated = $validator->validated();

        // Convert timezone to text
        $validated['timezone'] = timezoneList()[$validated['timezone']]['label'];

        Player::create([
            'user_id' => Auth::user()->id,
            'data' => $validated,
            'status' => 1
        ]);

        if ($type == "player") {
            $this->verifyPlayer();
        }

        return back()->with('success', $msg);
    }
}
