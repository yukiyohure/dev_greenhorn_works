<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stores extends Model
{
    use SoftDeletes;

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

