<?php
namespace App\Socialite;
class SocialiteManager extends \Laravel\Socialite\SocialiteManager
{
    protected function createSlackDriver()
    {
        $config = $this->app['config']['services.slack'];
        return $this->buildProvider('App\Socialite\Two\SlackProvider', $config);
    }
}