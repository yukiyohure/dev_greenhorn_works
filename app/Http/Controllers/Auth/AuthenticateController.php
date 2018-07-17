<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\UserInfos;
use App\Models\User;


class AuthenticateController extends Controller
{
    protected $userInfos;
    protected $users;

    public function __construct(UserInfos $userInfos, User $users)
    {
        $this->userInfos = $userInfos;
        $this->users = $users;
    }

    public function slackAuth()
    {
        return Socialite::with('slack')->scopes(['identity.basic', 'identity.email', 'identity.team'])->redirect();
    }

    public function userinfo()
    {
        if (array_key_exists('error', $_GET)) {
            return redirect('/');
        };

        $userData = Socialite::with('slack')->user();
        list($firstName, $lastName) = $this->splitUserName($userData->name);

        $userInfo = $this->userInfos->getSlackUserInfos($userData);
        $savedUserInfo = $this->userInfos->saveUserInfos($userInfo, $firstName, $lastName, $userData);

        $userInfoId = $savedUserInfo->id;
        $user = $this->users->getSlackUsers($userInfoId);
        $savedUser = $this->users->saveUser($user, $userData, $userInfoId);

        Auth::login($savedUser);
        return redirect('/');
    }

    public function splitUserName($fullName)
    {
        $splitName = explode(" ", $fullName);
        $firstName = $splitName[0];
        $lastName = end($splitName);
        return [$firstName, $lastName];
    }

}

