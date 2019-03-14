<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserInfos;
use App\Models\User;
use App\Models\Stores;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $userInfos;
    private $users;
    private $stores;

    public function __construct(User $users, UserInfos $userInfos, Stores $stores)
    {
    	$this->userInfos = $userInfos;
    	$this->users = $users;
    	$this->stores = $stores;
    	$this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
		$keyword = $request->all();
    	$users = $this->userInfos->getDataBySearch($keyword);
    	$stores = $this->stores->all();
    	return view('admin.user.index', compact('users', 'stores'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$user = $this->users->find($id);
        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->users->find($id);
        $stores = $this->stores->all();
        return view('admin.user.edit', compact('user', 'stores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $this->userInfos->find($id)->fill($input)->save();
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
        $this->userInfos->find($id)->delete();
        $this->users->find($id)->delete();
        return redirect()->route('admin.user.index');
    }
}
