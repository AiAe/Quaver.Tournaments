<?php

namespace App\Console\Commands;

use App\Http\Controllers\Staff\StaffController;
use App\Models\User;
use Illuminate\Console\Command;

class CachePlayers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:players';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Caches all the player\'s rank';

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
        StaffController::fetchStaff();

        $players = User::query()->has('player')->get();

        $sum_ranks = 0;
        $temp_players = array();
        foreach ($players as $player) {
            $this->info('Caching ' . $player['quaver_username']);
            $temp_players += [$player['quaver_username'] => $player->quaver_player['keys4']['globalRank']];
            $sum_ranks += $player->quaver_player['keys4']['globalRank'];
        }

        $this->info('Done');
    }
}
