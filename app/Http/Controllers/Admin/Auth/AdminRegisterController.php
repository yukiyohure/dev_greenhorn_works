<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Register\AdminRegistered;
use App\Models\AdminUsers;
use App\Models\UserInfos;

class AdminRegisterController extends Controller
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
    protected $redirectTo = '/admin';
    protected $adminuser;
    protected $userinfo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AdminUsers $adminuser, UserInfos $userinfo)
    {
        $this->middleware('guest');
        $this->adminuser = $adminuser;
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
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function admincreate(array $data)
    {
        $mailpassword = env('MAIL_ADDRESSPASS');
        $mgethex = hex2bin($data['mquery']);
        $mdec = openssl_decrypt($mgethex, 'aes-256-ecb', $mailpassword);

        $privilegespassword = env('MAIL_PRIVILEGES');
        $pgethex = hex2bin($data['pquery']);
        $pdec = openssl_decrypt($pgethex, 'aes-256-ecb', $privilegespassword);
        $userinfo = $this->userinfo->getAdminUserEmail($mdec);
        return AdminUsers::create([
            'name' => $data['name'],
            'password' => bcrypt($data['password']),
            'user_info_id' => $userinfo['id'],
            'privileges' => $pdec,
        ]);

    }

    public function showAdminRegistrationForm(Request $request)
    {
        $url = $request->query();
        $view = !empty($url) ? view('admin.auth.register', compact('url')) : redirect()->route('admin.login');
        return $view;
    }

    public function adminRegister(Request $request)
    {
        $adminusers = $this->adminuser->all();
        $this->validator($request->all())->validate();

        event(new AdminRegistered($adminuser = $this->admincreate($request->all())));

        $this->guard()->login($adminuser);

        return $this->registered($request, $adminuser)
                        ?: redirect('admin/login');
    }

    public function showAdminMailEditForm(Request $request)
    {
        $url = $request->query();
        return view('admin.auth.mailedit', compact('url'));
    }

    public function adminEmailUpdate(Request $request)
    {
        $input = $request->all();
        $email = $input['email'];

        $mailpassword = env('MAIL_ADDRESSPASS');
        $mgethex = hex2bin($input['mquery']);
        $mdec = openssl_decrypt($mgethex, 'aes-256-ecb', $mailpassword);
        $this->userinfo->getAdminUserEmail($mdec)->update([
            'email' => $input['email'],
        ]);

        return redirect()->route('admin.adminuser');
    }

}

