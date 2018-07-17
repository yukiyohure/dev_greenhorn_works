<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Intervention\Image\ImageManagerStatic as Image;

class WorkSchedules extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;

    public $updateDir = 'schedules/';

    protected $fillable = [
        'user_id',
        'file_path',
        'file_name',
        'file_type',
        'year',
        'month',
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function scopeWhereUserId($query, $userId = NULL)
    {
        if (!isset($userId)) {
            return $query;
        }
        return $query->where('user_id', $userId);
    }

    public function scopeWhereDate($query, $field, $date)
    {
        if (!$field || !$date) {
            return $query;
        }
        switch($field) {
            case 'year':
            case 'month':
                return $query->where($field, $date);
                break;
            default:
                return $query;
      }
    }

    //年月が一致するデータで絞る
    public function scopeDateRange($query, $input)
    {
        //年月の両方が未入力の場合は何もしない
        if (!isset($input['year']) && !isset($input['month'])) {
            return $query;
        }
        $fields = ['year', 'month'];
        foreach($fields as $field) {
            $query->WhereDate($field, $input[$field]);
        }
    }

    //苗字、名前が一致するデータで絞る
    public function scopeUserInfo($query, $input)
    {
        //苗字、名前の両方が未入力の場合は何もしない
        if (!isset($input['first_name']) && !isset($input['last_name'])) {
            return $query;
        }
        return $query->whereHas('user', function($query) use ($input) {
            return $query->whereHas('info', function ($query) use ($input) {
                $fields = ['first_name', 'last_name'];
                foreach($fields as $field) {
                    $query->whereName($field, $input[$field]);
                }
            });
        });
    }

    //一覧表示（検索の場合は検索結果を表示）
    public function getSchedules($input = NULL, $userId = NULL)
    {
        return $this->WhereUserId($userId)
                          ->DateRange($input)
                          ->UserInfo($input)
                          ->orderBy('year', 'desc')
                          ->orderBy('month', 'desc')
                          ->get();
    }

    public function saveUploadFile($uploadFile, $userId)
    {
        //ファイルの拡張子取得
        $fileType = $uploadFile->getClientOriginalExtension();
        //ファイルパスを取得
        $filePath = sprintf($this->updateDir.'%s/',$userId);

        //ファイル格納先のフォルダが存在しなければ作成
        if (!file_exists($filePath))  mkdir($filePath, 0777, true);
        //ファイル名が重複しないように変更
        $fileName = $this->changeFileName($fileType);
        //ファイル保存
        $this->saveFile($fileType, $uploadFile, $fileName, $filePath);

        return [
            'file_path' => $filePath,
            'file_name' => $fileName,
            'file_type' => $fileType,
        ];
    }

    public function changeFileName($fileType)
    {
        return md5(uniqid(rand(), true)) . '.' .$fileType;
    }

    public function saveFile($fileType, $uploadFile, $fileName, $filePath)
    {
        if ($fileType === 'pdf') {
            //PDFの処理
            $uploadFile->move($filePath, $fileName);
        } else {
            //画像の処理
            $img = Image::make($uploadFile);
            $img->save($filePath. $fileName);
        }
    }

    public function createSchedule($userId, $fileInfos, $year, $month)
    {
        $this->create([
            'user_id' => $userId,
            'file_path' => $fileInfos['file_path'],
            'file_name' => $fileInfos['file_name'],
            'file_type' => $fileInfos['file_type'],
            'year' => $year,
            'month' => $month,
        ]);
    }

    public function updateSchedule(array $fileInfos = NULL, $year, $month,$id)
    {
        if ($fileInfos !== NULL) {
            $this->where('id', $id)->update([
                'file_name' => $fileInfos['file_name'],
                'file_type' => $fileInfos['file_type'],
                'year' => $year,
                'month' => $month,
            ]);
        } else {
            //ファイルがアップロードされなかった場合は日付のみ更新
            $this->where('id', $id)->update([
                'year' => $year,
                'month' => $month,
            ]);
        }
    }

     //アップロードされた勤務表と同年月の勤務表が既にDBに存在しないか確認
    public function checkDate($year, $month, $userId, $id = NULL)
    {
        $sameDate = $this->where('year', $year)
                         ->where('month', $month)
                         ->where('user_id', $userId)
                         ->where('id', '!=', $id )
                         ->count();
        if ($sameDate === 0) {
          $errMsg = NULL;
        } else {
          $errMsg = $year .'年' . $month .'月'. 'の勤務表は既に保存されています。';
        }
        return $errMsg;
    }
}

