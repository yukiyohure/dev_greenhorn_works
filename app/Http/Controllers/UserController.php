<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\UserInfos;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public $userInfosModel;

    public function __construct(UserInfos $userInfosModel)
    {
        $this->middleware('auth');
        $this->userInfosModel = $userInfosModel;
    }

    public function index()
    {
        $userId = Auth::id();
        $isRegistered = $this->userInfosModel->getIsRegistered($userId);
        
        return view('index', compact('isRegistered'));
    }

    public function update(UpdateUserRequest $request)
    {
        $userId = Auth::id();
        $input = $request->all();
        $this->userInfosModel->updateUserInfoTest($input, $userId);
    
        return redirect()->route('home');        
    }

}

