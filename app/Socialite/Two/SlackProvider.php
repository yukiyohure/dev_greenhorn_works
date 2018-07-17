<?php

namespace App\Socialite\Two;

use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;

class SlackProvider extends AbstractProvider implements ProviderInterface
{
     public function getScopes()
    {
        return $this->scopes;
        if (count($this->scopes) > 0) {
           return $this->scopes;
        }
        return ['identity.basic', 'identity.email', 'identity.team'];
    }

    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase('https://slack.com/oauth/authorize', $state);
    }

    protected function getTokenUrl()
    {
        return 'https://slack.com/api/oauth.access';
    }

    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()->get(
                'https://slack.com/api/users.identity?token='.$token
            );
        return json_decode($response->getBody(), true);
    }
    protected function mapUserToObject(array $user)
    {
        return (new User())->setRaw($user)->map([
            'id' => array_get($user, 'user.id'),
            'name' => array_get($user, 'user.name'),
            'email' => array_get($user, 'user.email'),
            'avatar' => array_get($user, 'user.image_192'),
            'organization_id' => array_get($user, 'team.id'),
        ]);
    }
}