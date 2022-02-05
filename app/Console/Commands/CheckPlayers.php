<?php

namespace App\Console\Commands;

use App\Http\Controllers\Staff\StaffController;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class CheckPlayers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:players';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Manual check for who is not in the discord server';

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
        $players = User::query()->has('player')->get();

        foreach ($players as $player) {
            if (config('app.discord_bot')) {
                Redis::publish("discord_check", json_encode([
                    "quaver_id" => (string) $player['quaver_user_id'],
                    "quaver_username" => $player['quaver_username'],
                    "discord_id" => (string) $player['discord_user_id'],
                    "discord_nick" => $player['quaver_username']
                ]));
            }
        }

        $this->info('Done');
    }
}
