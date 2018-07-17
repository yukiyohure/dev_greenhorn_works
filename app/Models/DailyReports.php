<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class DailyReports extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'contents',
        'reporting_time',
    ];

    // 論削用
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * データを範囲で検索し、日報の情報を絞る。
     * データが空であれば処理なし。
     */
    public function scopeDateRange($query, $field, $start_date, $end_date)
    {
        if (!$field || (!$start_date && !$end_date)) {
            return $query;
        }

        switch($field) {
            case 'reporting_time':
                if ($start_date) {
                    $query->where($field, '>=', date($start_date));
                }
                if ($end_date) {
                    $query->where($field, '<=', date($end_date));
                }
                return $query;
                break;
            default:
                return $query;
        }
    }

    /**
     * userIdで特定のユーザーを検索し、日報の範囲を絞る。
     * userIdが空であれば処理なし。
     */
    public function scopeWhereUserId($query, $userId)
    {
        if (!$userId) {
            return $query;
        }
        return $query->where('user_id', $userId);
    }

    public function getAllReports()
    {
        return $this->orderBy('reporting_time', 'desc')->get();
    }

    public function getOwnReports($userId)
    {
        return $this->where('user_id', $userId)
                    ->orderBy('reporting_time', 'desc')
                    ->get();
    }

    /**
     * あるユーザーの複数ある日報を日付の範囲で指定し
     * 該当の日報を全て出力。
     *
     *  @param Array
     */
    public function getReportsByDateRange($inputs)
    {
        // ユーザーを検索
        $dataOfTheUser = $this->whereUserId($inputs['id']);

        // そのユーザーの日報の中から日付の範囲で検索
        $dataOfTheUser = $dataOfTheUser->dateRange("reporting_time", $inputs['start-date'], $inputs['end-date']);

        // 表示の順番を報告日付順に指定する。
        return $dataOfTheUser->orderBy('reporting_time')->get();
    }

    /**
     * ユーザーから送られた情報を正常化。
     *  @param Array
     */
    public function normalizeInputs($inputs)
    {
        if(is_array($inputs)) {
            $inputs = [
                'id' => isset($inputs['id']) ? $inputs['id'] : '',
                'start-date' => isset($inputs['start-date']) ? $inputs['start-date'] : '',
                'end-date' => isset($inputs['end-date']) ? $inputs['end-date'] : '',
                'first_name' => isset($inputs['first_name']) ? $inputs['first_name'] : '',
                'last_name' => isset($inputs['last_name']) ? $inputs['last_name'] : ''
            ];
        } else {
            $inputs = [
                'id' => '',
                'start-date' => '',
                'end-date' => '',
                'first_name' => '',
                'last_name' => ''
            ];
        }
        return $inputs;
    }

    /**
     * あるユーザーの日報を日付の範囲で指定し、取得。
     */
    public function getReportsBySearching($inputs)
    {
        return $this->dateRange("reporting_time", $inputs['start-date'], $inputs['end-date'])
                    ->whereHas('user', function($query) use ($inputs) {
                        return $query->whereHas('info', function ($query) use ($inputs) {
                            $fields = ['first_name', 'last_name'];
                            foreach ($fields as $field) {
                                $query->whereName($field, $inputs[$field]);
                            }
                        });
                    })
                    // 日報を作成した順に表示
                    ->orderBy('reporting_time', 'desc')->get();
    }

}

