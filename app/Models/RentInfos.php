<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentInfos extends Model
{
    protected $fillable = [
        'user_id',
        'item_id',
        'admin_user_id',
        'rental_request_at',
        'scheduled_return_at',
        'return_at',
        'rental_at',
        'approved_at',
    ];

    public function admin()
    {
        return $this->belongsTo('App\Models\AdminUsers', 'admin_user_id');
    }

    public function item()
    {
        return $this->belongsTo('App\Models\Items');
    }
}

