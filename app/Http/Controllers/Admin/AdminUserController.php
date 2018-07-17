<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AdminUsers;
use App\Models\UserInfos;
use App\Http\Requests\AdminUserRequest;
use App\Http\Requests\AdminUserEditRequest;
use Mail;
use App\Mail\AdminAccountRegister;
use App\Mail\AdminAccountMailEdit;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    protected $adminuser;
    protected $userinfo;

    public function __construct(AdminUsers $adminuser, UserInfos $userinfo)
    {
        $this->middleware('auth:admin');
        $this->adminuser = $adminuser;
        $this->userinfo = $userinfo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adminusers = $this->adminuser->all();

        // 自身のユーザー情報を取得
        $self_user_id = Auth::id();
        $selfinfo = $this->userinfo->getUserInfoByUserId($self_user_id);

        return view('admin.admin_user.index', compact('adminusers', 'selfinfo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admin_user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminUserRequest $request)
    {
        $input = $request->all();

        // ユーザーと店舗へのアクセス権限を文字列のバイナリーとして受け取り、
        // 組み合わせ一つにする。
        $fields = ['user_right', 'store_right'];
        $access_right = bindec($this->combineAccessRights($fields, $input));

        // 社員コードの正常化
        $position_code = (int) $input['position_code'] ?? 100; // デフォルト値は100

        // user_infosテーブルに管理者の情報を登録する。
        $this->userinfo->create([
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'sex' => $input['sex'],
            'birthday' => $input['birthday'],
            'email' => $input['email'],
            'tel' => $input['tel'],
            'hire_date' => $input['hire_date'],
            'store_id' => 0,
            'access_right' => $access_right,
            'position_code' => $position_code
        ]);

        Mail::to($input['email'])->send(new AdminAccountRegister($input));

        return redirect()->route('admin.adminuser.index');
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
        $selfinfo = $this->userinfo->getUserInfoByUserId($self_user_id);

        $adminuser = $this->adminuser->find($id);
        return view('admin.admin_user.show', compact('adminuser', 'selfinfo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $adminuser = $this->adminuser->find($id);
        return view('admin.admin_user.edit', compact('adminuser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUserEditRequest $request, $id)
    {
        $adminuser =  $this->adminuser->find($id);
        $input =  $request->all();
        $this->userinfo->updateUserInfo($input, $adminuser);

        return redirect()->route('admin.adminuser.index');
    }

    public function mailedit($id)
    {
        $adminuser = $this->adminuser->find($id);
        return view('admin.admin_user.mailedit', compact('adminuser'));
    }

    public function sendmail(Request $request)
    {
        $input = $request->all();
        $email = $input['email'];
        Mail::to($email)->send(new AdminAccountMailEdit($email));

        return redirect()->route('admin.adminuser.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $data = $this->adminuser->find($id);
        $userinfoid = $data['user_info_id'];
        $userinfo = $this->userinfo->getAdminUserId($userinfoid);
        $data->info()->delete();
        $data->delete();

        return redirect()->route('admin.adminuser.index');
    }

    /**
     * checkboxから来た二つ権限（user_right, store_right）を一つに組み合わ、
     * バイナリー（文字列）から数字に変換する。
     * 例） user_right('1')  --->
     *                           binary '10' ---> number 2 ---> access_right(2)
     *     store_right('0')  --->
     */
    public function combineAccessRights($fields, $input) {
        $access_right = '';
        foreach ($fields as $field) {
            $input[$field] = $input[$field] ?? '0';
            $access_right .= $input[$field];
        }

        return $access_right;
    }

}

