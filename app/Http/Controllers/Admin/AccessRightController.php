<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ApplicationMail;
use App\Mail\PermissionMail;
use App\Models\AdminUsers;
use App\Models\UserInfos;
use App\Http\Requests\AccessRightRequest;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Services\Classes\Cryptogram;

class AccessRightController extends Controller
{
    protected $adminusers;
    protected $userinfos;

    public function __construct (AdminUsers $adminusers, UserInfos $userinfos)
    {
        $this->middleware('auth:admin');
        $this->adminusers = $adminusers;
        $this->userinfos = $userinfos;
    }

    public function index()
    {
        $adminuser_id = Auth::id();

        // 管理者のログインIDを元に管理者情報を取得
        $adminuser = $this->adminusers->getAdminUser($adminuser_id)->first();

        // status_codeがそのユーザーよりも高い管理者は全て除外して取得
        $adminuserinfos = $this->userinfos->getAdminUsersByPositionCode($adminuser['user_info_id'])->all();
        //id１番の管理者が/admin/access_right/3と入力しても飛べないようにする。

        return view('admin.access_right.index', compact('adminuserinfos'));
    }

    public function sendMail(Request $request)
    {
        $admin_user_id = Auth::id();

        // 申請者からの入力情報を全て取得
        // 内容: authorizer_id, message
        $inputs = $request->all();

        // 管理者の詳細情報をIdで取得
        $adminuserinfo = $this->userinfos
                              ->getUserInfoByAdminUserId($admin_user_id)
                              ->first();

        // 承認者のメールアドレスを承認者のuser_info_idで検索し、UserInfosテーブルから取得
        $authorizer_email = $this->userinfos
                                 ->getEmailByUserInfoId($inputs['authorizer_id'])
                                 ->first()
                                 ->email;

        $inputs['user_info_id'] = $adminuserinfo['id'] ?? '';
        $inputs['first_name'] = $adminuserinfo['first_name'] ?? '';
        $inputs['last_name'] = $adminuserinfo['last_name'] ?? '';
        $inputs['email'] = $adminuserinfo['email'] ?? '';
        $inputs['authorizer_email'] = $authorizer_email;

        // メールで内容とView (access_permission_email.blade.php)を付与して送信
        Mail::to($authorizer_email)->send(new ApplicationMail($inputs));

        // メール送信完了画面を表示
        return view('admin.access_right.email_sent');
    }

    public function replyMail(Request $request, $query)
    {
        $inputs = $request->all();

        // 入力フォームから来たデータを正常化
        $inputs = $this->normalizeInputs($inputs);

        // データを復号し、申請者の情報を取得
        $applicant = Cryptogram::easyDecryption($query);

        // アクセス権限を許可
        $this->userinfos->permitAccessRights($applicant['user_info_id'], $inputs);

        Mail::to($applicant['email'])->send(new PermissionMail($inputs));

        return view('admin.access_right.email_replied');
    }

    public function permission(Request $request)
    {
        $query = $request->query()['data'] ?? false;
        $view = $query ? view('admin.access_right.permission', compact('query')) : redirect()->route('admin.login');
        return $view;
    }

    public function normalizeInputs($inputs)
    {
        if (is_array($inputs)) {
            $inputs['user_right'] = $inputs['user_right'] ?? '0';
            $inputs['store_right'] = $inputs['store_right'] ?? '0';
            $inputs['admin_right'] = $inputs['admin_right'] ?? '0';
        } else {
            $inputs = [
                'user_right' => '0',
                'store_right' => '0',
                'admin_right' => '0'
            ];
        }

        return $inputs;
    }

}

