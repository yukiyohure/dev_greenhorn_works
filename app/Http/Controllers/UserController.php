<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserInfos;

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

    public function update(Request $request)
    {
        $userId = Auth::id();

        $input = $request->all();
        
        $rules = [
            'sex' => 'required',
            'store_id' => 'required|min:1|max:3',
            'tel' => 'required',
            'birthday' => 'required',
            'hire_date' => 'required'
        ];
        
        $validation = \Validator::make($input,$rules);
        
        if($validation->fails())
        {
            return redirect()->back()->withErrors($validation->errors())->withInput();
        }
        
        $this->userInfosModel->updateUserInfoTest($input, $userId);
        
        return redirect()->route('home');
    }

}

