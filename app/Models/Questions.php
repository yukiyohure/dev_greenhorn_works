<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use cebe\markdown\Markdown;

class Questions extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'tag_category_id',
        'title',
        'content',
        'answer',
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\TagCategory', 'tag_category_id');
    }

    public function parse()
    {
        $parser = new Markdown();
        return $parser->parse($this->content);
    }

    public function getMarkContentAttribute()
    {
        return $this->parse();
    }

    public function getAllQuestions()
    {
        $question = $this->orderBy('question_time', 'desc')
                         ->get();
        return $question;
    }

    public function getMyPageQuestions($user_id)
    {

        return $this->where('user_id', $user_id)->get();

    }

    public function createQuestion($data, $userId)
    {

        $this->create([
            'user_id' => $userId,
            'tag_category_id' => $data['tag_category_id'],
            'title' => $data['title'],
            'content' => $data['content'],
        ]);
    }

    public function updateQuestion($data, $id, $userId)
    {
        $rec = $this->find($id);
        $rec->user_id = $userId;
        $rec->title = $data['title'];
        $rec->tag_category_id = $data['tag_category_id'];
        $rec->content = $data['content'];
        $rec->save();
    }

    public function updateAnswer($data)
    {
        $this->find($data['id'])->update([
            "answer" => $data['answer'],
        ]);
    }

    public function getSearchedQuestionTitle($inputs)
    {
        return $this->where('title', 'LIKE',"%" . $inputs['search'] . "%")
                    ->get()
                    ->when($inputs['tag_category_id'], function($query) use ($inputs) {
                        return $query->where('tag_category_id', $inputs['tag_category_id']);
                    });
    }
}

