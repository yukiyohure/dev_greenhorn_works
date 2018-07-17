<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class TagCategory extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;

    protected $fillable = ['name'];

    protected $dates = ['deleted_at'];

}
