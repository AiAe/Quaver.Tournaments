<?php

namespace App\Providers\Socialite;

use GuzzleHttp\RequestOptions;
use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\User;

class DiscordSocialiteProvider extends AbstractProvider
{
    public const IDENTIFIER = 'DISCORD';

    protected $scopes = [
        'identify'
    ];

    protected $scopeSeparator = ' ';

    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase(
            'https://discord.com/api/oauth2/authorize',
            $state
        );
    }

    protected function getTokenUrl()
    {
        return 'https://discord.com/api/oauth2/token';
    }

    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()->get(
            'https://discord.com/api/users/@me',
            [
                RequestOptions::HEADERS => [
                    'Authorization' => 'Bearer ' . $token,
                ],
            ]
        );

        return json_decode((string)$response->getBody(), true);
    }

    protected function getTokenFields($code)
    {
        return array_merge(parent::getTokenFields($code), [
            'grant_type' => 'authorization_code',
        ]);
    }

    protected function mapUserToObject(array $user)
    {
        return (new User())->setRaw($user)->map([
            'discord_user_id' => $user['id'],
            'discord_username' => sprintf('%s#%s', $user['username'], $user['discriminator'])
        ]);
    }
}
