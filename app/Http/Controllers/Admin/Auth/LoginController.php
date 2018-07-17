<?php
namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/admin';

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function showLoginForm()
    {

        return view('admin.auth.login');
    }

    public function guard()
    {
        return Auth::guard('admin');
    }

    public function username()
    {
        return 'name';
    }

    public function logout()
    {
        $this->guard()->logout();
        return redirect()->route('admin.login');
    }
}
