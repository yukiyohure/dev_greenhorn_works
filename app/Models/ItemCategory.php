<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Items;

class ItemCategory extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;

    protected $fillable = [
        'category',
    ];

    protected $dates = ['deleted_at'];

    public function item()
    {
        return $this->belongsTo(Items::class, 'id', 'item_category_id');
    }

    public function createItemCategory($data)
    {
        $this->create([
            'category' => $data['category']
        ]);
    }

    public function updateItemCategory($data)
    {
        $this->where('id', $data['id'])->update([
            'category' => $data['category']
        ]);
    }

}

