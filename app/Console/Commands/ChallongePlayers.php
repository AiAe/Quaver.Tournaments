<?php

namespace App\Console\Commands;

use App\Http\Controllers\Staff\StaffController;
use App\Models\Player;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class ChallongePlayers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'challonge:players';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $str_list = $this->ask('User ids array: ');

        // Remove everyone from the tournament
        $players = Player::query()->with('user')->where('status', 1)->get();

        foreach ($players as $player) {
            if (config('app.discord_bot')) {
                Redis::publish("discord_remove", json_encode([
                    "discord_id" => (string) $player->user['discord_user_id'],
                    "discord_nick" => $player->user['quaver_username']
                ]));
            }

            $player->status = 0;
            $player->save();
        }

        try {
            $json = json_decode($str_list, true);

            foreach ($json as $player) {
                $user = User::where('quaver_user_id', $player)
                    ->with('player')->has('player')->first();

                if($user) {
                    $user->player->status = 1;
                    $user->updateQuaverUsername();
                    $user->createChallongePlayer();

                    $user->player->save();
                    $user->save();

                    if (config('app.discord_bot')) {
                        Redis::publish('discord', json_encode([
                            "discord_id" => (string) $user['discord_user_id'],
                            "discord_nick" => $user['quaver_username']
                        ]));
                    }
                } else {
                    $this->warn('User #' . $player . " not found!");
                }
            }
        } catch (\Exception) {
            $this->error('Failed to parse');
        }

        $this->info('Done');
    }
}
