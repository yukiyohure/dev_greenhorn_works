<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Stores extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;

    protected $fillable = [
        'name',
        'kana_name',
    ];

    protected $dates = ['deleted_at'];

    public function getSearchedStoreName($input)
    {
        return $this->where('name', 'LIKE',"%" . $input['storeName'] . "%")->orderBy('kana_name', 'asc')->get();
    }
}

