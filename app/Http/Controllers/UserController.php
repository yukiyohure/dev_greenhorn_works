<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\UserInfos;
use App\Http\Requests\UpdateUserRequest;
// use Illuminate\Http\Request;

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
        $requiredColumn = $this->userInfosModel->getCheckColumn($userId);
        extract($requiredColumn);

        if (!$is_registered) {
            if (!empty($tel) && !empty($sex) && !empty($store_id) && !empty($birthday) && !empty($hire_date)) {
                $requiredColumn = $this->userInfosModel->updateCheckColumn($userId, $requiredColumn);
            }

            return view('index', compact('requiredColumn'));
        }
        
        if (empty($tel) || empty($sex) || empty($store_id) || empty($birthday) || empty($hire_date)) {
            $requiredColumn['is_registered'] = 0;
        }

        return view('index', compact('requiredColumn'));
    }

    public function update(UpdateUserRequest $request)
    {
        $userId = Auth::id();
        $input = $request->all();
        $this->userInfosModel->updateUserInfoTest($input, $userId);

        return redirect()->route('home');        
    }

}

