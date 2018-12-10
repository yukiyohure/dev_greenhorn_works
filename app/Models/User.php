<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'password',
        'user_info_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function info()
    {
        return $this->belongsTo('App\Models\UserInfos', 'user_info_id');
    }

    public function dailyReport()
    {
        return $this->hasMany('App\Models\DailyReports', 'user_id');
    }


    public function getSlackUsers($userInfoId)
    {
        return $this->firstOrNew(['user_info_id' => $userInfoId]);
    }

}

