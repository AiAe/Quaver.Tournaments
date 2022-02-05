<?php

namespace App\Http\Controllers\Admin\Players;

use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class PlayersController extends Controller
{

    public function page(Request $request)
    {
        $pageData[] = "";
        $pageData['seo']['title'] = "Players";

        $players = Player::query()->with('user');

        if (isset($request['search'])) {
            $search = strip_tags($request['search']);
            $users = User::select(['id'])->where('quaver_username', 'like', '%'.$search.'%')->get();

            if (count($users)) {
                foreach ($users as $user) {
                    $players->orWhere('user_id', $user->id);
                }
            }

            $pageData['search'] = $search;
        }

        $pageData['players'] = $players->paginate(50);

        return view('admin/players/players', $pageData);
    }

    public function status(Request $request, $id)
    {
        $user = Auth::user();

        if ($user->role !== 100) {
            return back()->with('error', 'You don\'t have access to this action');
        }

        $player = Player::where('user_id', $id)->with('user')->first();

        $status = (int) !$player->status;

        $player->status = $status;

        $action = "discord";

        if (!$status) {
            $action = "discord_remove";
        }

        if (config('app.discord_bot')) {
            Redis::publish($action, json_encode([
                "discord_id" => (string) $player->user['discord_user_id'],
                "discord_nick" => $player->user['quaver_username']
            ]));
        }

        $player->save();

        return back()->with('success', 'Success');
    }

}
