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

        $pageData['has_registered'] = Player::query()->where('user_id', Auth::user()->id)->where('status', 1)->first();

        return view('signup/player', $pageData);
    }

    public function closed()
    {
        $pageData[] = "";
        $pageData['seo']['title'] = "Closed!";
        $pageData['text'] = "Tournament registration is not started yet!";

        return view('signup.closed', $pageData);
    }

    private function verifyPlayer()
    {
        $player = Auth::user();
        $player->updateQuaverUsername();

        if (config('app.challonge_api'))
            $player->createChallongePlayer();

        if (config('app.discord_bot'))
            Redis::publish('discord', json_encode([
                "discord_id" => (string) $player['discord_user_id'],
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

    public function saveStaff(Request $request)
    {
        $rules = [
            'roles' => ["array", "min:1", "required", new StaffRoleValidation()],
            'previous_experience' => 'required'
        ];
        $msg = 'You applied successfully!';

        $validator = Validator::make($request->all(), $rules);

        $validator->validate();
        $validated = $validator->validated();

        Form::create([
            'user_id' => Auth::user()->id,
            'type' => Form::TYPE['staff'],
            'data' => $validated
        ]);

        return back()->with('success', $msg);
    }

    public function savePlayer(Request $request)
    {
        $rules = [
            'timezone' => ["required", "numeric"]
        ];

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

        $this->verifyPlayer();

        return back()->with('success', "You registered successfully!");
    }

    public function updateTimezone(Request $request) {
        $rules = [
            'timezone' => ["required", "numeric"]
        ];

        $validator = Validator::make($request->all(), $rules);

        $validator->validate();
        $validated = $validator->validated();

        // Convert timezone to text
        $validated['timezone'] = timezoneList()[$validated['timezone']]['label'];

        $player = Player::where('user_id', Auth::user()->id)->first();

        $data = $player->data;

        $data['timezone'] = $validated['timezone'];
        $player->data = $data;

        $player->save();

        return back()->with('success', 'Updated timezone successfully!');
    }
}
