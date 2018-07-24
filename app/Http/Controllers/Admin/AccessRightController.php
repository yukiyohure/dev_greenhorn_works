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
        $adminUserId = Auth::id();

        // 申請者からの入力情報を全て取得
        // 内容: authorizer_id, message
        $inputs = $request->all();

        // 管理者の詳細情報をIdで取得
        $adminUserInfo = $this->userinfos
                              ->getUserInfoByAdminUserId($adminUserId)
                              ->first();

        $inputs['user_info_id'] = $adminUserInfo['id'] ?? '';
        $inputs['first_name'] = $adminUserInfo['first_name'] ?? '';
        $inputs['last_name'] = $adminUserInfo['last_name'] ?? '';
        $adminUserFullname = $inputs['last_name'] . " " . $inputs['first_name'];

        //以下slack Apiのロジック
        $slackApiKey = 'xoxp-42620444977-362509122881-400641301381-e88a476b0565405b24d0e1ed3b31a695'; //上で作成したAPIキー //ok
        $text = "{". $adminUserFullname . "}さんからのお問い合わせ: " .  "「" . $inputs['message'] . "」";
        $textTarget = urlencode($text);
        $channelTarget = urlencode("@jun.okb.115");
        $url = "https://slack.com/api/chat.postMessage?token=${slackApiKey}&channel=${channelTarget}&as_user=false&username=greenhorn_bot&text=${textTarget}";
        $respons = file_get_contents($url);

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

