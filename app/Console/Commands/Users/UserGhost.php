<?php

namespace App\Console\Commands\Users;

use App\Enums\UserRoles;
use App\Models\User;
use Illuminate\Console\Command;
use MagicLink\Actions\LoginAction;
use MagicLink\MagicLink;

class UserGhost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:ghost';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Login as another user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $username = $this->ask('Enter username');

        $user = User::where('username', $username)->first();

        if ($user) {
            $url = MagicLink::create(new LoginAction($user, null), 2, numMaxVisits: 1)
                ->protectWithAccessCode($user->username);

            if (!$url) {
                $this->error('Failed to generate url!');
            } else {
                $this->info(sprintf('%s/%s/%s:%s',
                    config('app.url'),
                    config('magiclink.url.validate_path'),
                    $url->id,
                    $url->token));

                $this->info('Passcode is their username!');
            }
        } else {
            $this->error('User not found!');
        }
    }
}
