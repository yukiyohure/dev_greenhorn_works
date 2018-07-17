<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\request;
use Illuminate\Support\Facades\DB;
use App\Models\UserInfos;
use Illuminate\Support\Facades\Request as test;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected $register;
    protected $userinfo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user, UserInfos $userinfo)
    {
        $this->middleware('guest');
        $this->register = $user;
        $this->userinfo = $userinfo;
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            // 'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $hex = $data['hash'];
        $mailpassword = env('MAIL_ADDRESSPASS');
        $mailhex = hex2bin($hex);
        $maildecrypt = openssl_decrypt($mailhex, 'aes-256-ecb', $mailpassword);
        $user = $this->userinfo->getUserRecord($maildecrypt);
        //Whereを使って、復号化したメアドを元にUSERINFOSテーブルのレコード取得している。
        // idwotoru
        // usertable infoid ni ireru hensuu ni ireru
        $this->register->create([
            'name' => $data['name'],
            // 'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'user_info_id' => $user['id']
        ]);
    }


    //hex2bin関数とopenssl_decryptで16進数に変換されたメアドを元の文字列に戻す。

    //順番としては、１．アカウント登録ボタンが押された時に、URLも末尾に暗号化されているメアドを復号化して、２．それを元にUSERINFOSテーブルのそのメアドと同じメアドを持つユーザーのレコードを探す。３．そのレコードからIDを引っ張り、ユーザーテーブルに入れる。４．そして、ユーザーがアカウント登録画面で入力したユーザー名とパスワードと共にUSERINFOIDが保存される。

    public function register(RegisterRequest $request)
    {
        $this->create($request->all());
        return redirect()->route('login');
    }

    protected function showRegistrationForm(Request $request)
    {
        $url = $request->query();
        $view = !empty($url) ? view('auth.register', compact('url')) : redirect()->route('login');
        return $view;
    }
}

