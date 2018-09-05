<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Stores;
use App\Models\UserInfos;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $users;
    protected $stores;
    protected $userinfos;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(User $users, Stores $stores, UserInfos $userinfos)
    {
        $this->middleware('auth:admin');
        $this->users = $users;
        $this->stores = $stores;
        $this->userinfos = $userinfos;
    }

    public function index(Request $request)
    {
        $inputs = $request->all();

        // 管理者からのインプットを正常化
        $inputs = $this->users->normalizeInputs($inputs);

        // 自身のユーザー情報を取得
        $self_user_id = Auth::id();
        $selfinfo = $this->userinfos->getUserInfoByUserId($self_user_id);

        // デフォルト： ユーザー情報全権取得
        // 管理者が指定した条件によりユーザー情報を取得
        $users = $this->users->getUsersFromSearchingResult($inputs);

        $stores = $this->stores->all();
        return view('admin.user.index', compact('users', 'stores', 'selfinfo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 自身のユーザー情報を取得
        $self_user_id = Auth::id();
        $selfinfo = $this->userinfos->getUserInfoByUserId($self_user_id);

        // 選択した研修生の情報を取得
        $user =  $this->users->find($id);
        return view('admin.user.show', compact('user', 'selfinfo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user =  $this->users->find($id);
        $stores = $this->stores->orderBy('kana_name', 'asc')->get();
        return view('admin.user.edit', compact('user', 'stores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $input =  $request->all();
        $this->userinfos->updateUserInfo($input, $id);

        User::where('id', $id)->update(['name' => $input['name']]);

        return redirect()->route('admin.user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user =  $this->users->find($id);
        $userinfo = $this->userinfos->find($user['user_info_id']);

        $userinfo->delete();
        $user->delete();

        return redirect()->route('admin.user.index');
    }

     public function getUserList($id)
    {
      return UserInfos::where('store_id', $id)->get();
    }

}

