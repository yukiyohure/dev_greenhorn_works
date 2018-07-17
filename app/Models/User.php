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

    /**
     * ユーザー名で検索
     * データが空であれば処理なし。
     */
    public function scopeWhereName($query, $field, $name)
    {
        // fieldまたはnameに情報が入っていなければ、処理を終了。
        if (!$field || !$name) {
            return $query;
        }

        // fieldの値がname以外は処理しない。
        switch($field) {
            case 'name':
                return $query->where($field, 'like', '%' . $name . '%');
                break;
            default:
                return $query;
        }
    }

    /**
     * 管理者の指定した条件で検索し、ユーザーデータを取得
     */
    public function getUsersFromSearchingResult($inputs)
    {
        // ユーザー名で条件を絞る
        return $this->whereName('name', $inputs['user_name'])
                    // 姓名で条件を絞る
                    ->whereHas('info', function($query) use ($inputs) {
                        $name_fields = ['first_name', 'last_name'];
                        foreach($name_fields as $name_field) {
                            $query->whereName($name_field, $inputs[$name_field]);
                        }
                    })
                    // 性別、Email、電話番号で条件を絞る
                    ->whereHas('info', function($query) use ($inputs) {
                        $equal_fields = ['sex', 'email', 'tel'];
                        foreach ($equal_fields as $equal_field) {
                            $query->equal($equal_field, $inputs[$equal_field]);
                        }
                    })
                    // 誕生日と開始日の範囲指定で条件を絞る
                    ->whereHas('info', function($query) use ($inputs) {
                        return $query->dateRange('birthday', $inputs['birthday-start-date'], $inputs['birthday-end-date'])
                                     ->dateRange('hire_date', $inputs['hire_date-start-date'], $inputs['hire_date-end-date']);
                    })
                    // 店舗名で条件を絞る
                    ->whereHas('info', function($query) use ($inputs) {
                        return  $query->whereHas('store', function($query) use ($inputs) {
                            if ($inputs['store_id']) {
                                return $query->where('id', $inputs['store_id']);
                            } else {
                                return $query;
                            }
                        });
                    })
                    // 情報を整理する
                    ->orderBy('created_at', 'desc')->get();
    }

    /**
     * 管理者が入力したデータを正常化
     */
    public function normalizeInputs($inputs) {
        if (is_array($inputs)) {
            $inputs = [
                "user_name" => isset($inputs['user_name']) ? $inputs['user_name'] : "",
                "sex" => isset($inputs['sex']) ? $inputs['sex'] : "",
                "last_name" => isset($inputs['last_name']) ? $inputs['last_name'] : "",
                "first_name" => isset($inputs['first_name']) ? $inputs['first_name'] : "",
                "birthday-start-date" => isset($inputs['birthday-start-date']) ? $inputs['birthday-start-date'] : "",
                "birthday-end-date" => isset($inputs['birthday-end-date']) ? $inputs['birthday-end-date'] : "",
                "email" => isset($inputs['email']) ? $inputs['email'] : "",
                "tel" => isset($inputs['tel']) ? $inputs['tel'] : "",
                "hire_date-start-date" => isset($inputs['hire_date-start-date']) ? $inputs['hire_date-start-date'] : "",
                "hire_date-end-date" => isset($inputs['hire_date-end-date']) ? $inputs['hire_date-end-date'] : "",
                "store_id" => isset($inputs['store_id']) ? $inputs['store_id'] : ""
            ];
        } else {
            $inputs = [
                "user_name" => "",
                "sex" => "",
                "last_name" => "",
                "first_name" => "",
                "birthday-start-date" => "",
                "birthday-end-date" => "",
                "email" => "",
                "tel" => "",
                "hire_date-start-date" => "",
                "hire_date-end-date" => "",
                "store_id" => ""
            ];
        }

        return $inputs;
    }

    public function getSlackUsers($userInfoId)
    {
        return $this->firstOrNew(['user_info_id' => $userInfoId]);
    }

    public function saveUser($user, $userData, $userInfoId)
    {
        $user->name = $userData->name;
        $user->password = $userData->id;
        $user->user_info_id = $userInfoId;
        $user->save();
        return $user;
    }
}

