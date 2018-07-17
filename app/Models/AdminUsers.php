<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUsers extends Authenticatable implements Transformable
{
    use TransformableTrait, SoftDeletes;

    protected $fillable = [
        'name',
        'password',
        'user_info_id',
        'privileges',
    ];

    protected $hidden = [
        'password',
    ];

    protected $dates = ['deleted_at'];

    public function info()
    {
        return $this->belongsTo('App\Models\UserInfos', 'user_info_id');
    }

    public function getUsersBasedOnTheConditions($inputs)
    {
        return $this->whereHas('stores');
    }

    public function getAdminUser($adminuser_id)
    {
        return $this->when($adminuser_id, function($query) use ($adminuser_id) {
            return $query->where('id', $adminuser_id);
        });
    }

    public function getAdminUsersByPositionCode($admin_user_info_id)
    {
        $adminuserinfo = $this->when($admin_user_info_id, function($query) use ($admin_user_info_id) {
            return $query->where('id', $admin_user_info_id);
        });

        return $this->filterByPositionCode($adminuserinfo['position_code'])->get();
    }

}

