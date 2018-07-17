<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ItemCategory;

class Items extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;

    protected $fillable = [
        'item_category_id',
        'name',
        'item_info',
    ];

    protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->belongsTo(ItemCategory::class, 'item_category_id');
    }

    public function scopeWhereName($query, $field, $name)
    {
        if (!$field || !$name) {
            return $query;
        }

        switch ($field) {
            case 'name':
                return $query->where($field, 'like', '%' . $name . '%');
                break;
            default:
                $query;
        }
    }

    public function createItems($data)
    {
        $this->create([
            "name" => $data['name'],
            "item_category_id" => $data['item_category_id'],
            "item_info" => $data['item_info'],
        ]);
    }

    public function updateItemById($data)
    {
        $this->where('id', $data['id'])->update([
            "name" => $data['name'],
            "item_category_id" => $data['item_category_id'],
            "item_info" => $data['item_info']
        ]);
    }

    public function getItemsBySearching($data)
    {
        return $this->whereName('name', $data['name'])->whereHas('category', function($query) use ($data) {
                if ($data['item_category_id']) {
                    return$query->where('id', $data['item_category_id']);
                } else {
                    return $query;
                }
        })->get();
    }

}

