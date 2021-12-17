<?php

namespace App\Providers\Socialite;

use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\User;

class QuaverSocialiteProvider extends AbstractProvider
{
    public const IDENTIFIER = 'QUAVER';

    public function getQuaverUrl()
    {
        return 'https://quavergame.com/oauth2';
    }

    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase($this->getQuaverUrl() . '/authorize', $state);
    }

    protected function getTokenUrl()
    {
        return $this->getQuaverUrl() . '/token';
    }

    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()->post($this->getQuaverUrl() . '/me', [
            'headers' => [
                'Authorization' => 'Bearer ' . config('services.quaver.client_secret'),
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            'form_params' => [
                'code' => $token
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    protected function mapUserToObject(array $user)
    {
        return (new User())->setRaw($user)->map([
            'quaver_user_id' => $user['user']['id'],
            'quaver_username' => $user['user']['username']
        ]);
    }
}
