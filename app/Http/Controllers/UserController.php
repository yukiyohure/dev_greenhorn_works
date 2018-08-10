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
        $requiredColumn = $this->userInfosModel->getCheckColumn($userId);

        if ($requiredColumn['is_registered'] === 0) {
            if (!empty($requiredColumn['tel']) && !empty($requiredColumn['sex']) && !empty($requiredColumn['store_id']) && !empty($requiredColumn['birthday']) && !empty($requiredColumn['hire_date'])) {
                $this->userInfosModel->updateIsRegistered($userId, $requiredColumn);
                $requiredColumn['is_registered'] = 1;
            }

            return view('index', compact('requiredColumn'));
        }

        if (empty($requiredColumn['tel']) || empty($requiredColumn['sex']) || empty($requiredColumn['store_id']) || empty($requiredColumn['birthday']) || empty($requiredColumn['hire_date'])) {
            $requiredColumn['is_registered'] = 0;
        } 

        return view('index', compact('requiredColumn'));
    }

    public function update(UpdateUserRequest $request)
    {
        $userId = Auth::id();
        $input = $request->all();
        $this->userInfosModel->updateUserInfoCheckColumn($input, $userId);//名前変更

        return redirect()->route('home');
    }

}

