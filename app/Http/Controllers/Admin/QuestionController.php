<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Questions;
use App\Models\TagCategory;
use App\Models\UserInfos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use cebe\markdown\Markdown;

class QuestionController extends Controller
{
    protected $question;
    protected $category;
    protected $user_info;

    public function __construct(Questions $question, TagCategory $category, UserInfos $user_info)
    {
        $this->middleware('auth:admin');
        $this->question = $question;
        $this->category = $category;
        $this->user_info = $user_info;
    }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
    public function index(Request $request)
    {
        $categories = $this->category->all();
        $inputs = $request->all();

        if (empty($inputs['search']) && empty($inputs['tag_category_id'])) {
            $questions = $this->question->all();
        } else {
            $questions = $this->question->getSearchedQuestionTitle($inputs);
        }

        return view('admin.question.index', compact('questions',  'categories'));
    }

    public function show($id)
    {
        $question = $this->question->find($id);
        return view('admin.question.show', compact('question'));
    }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
    public function edit(Request $request, $id)
    {
        $question = $this->question->find($id);
        return view('admin.question.edit', compact('question','id'));
    }

    public function create(Request $request)
    {
        $data = $request->all();
        $request->session()->put('data', $data);
        $question = $this->question->find($data['id']);
        return view('admin.question.create', compact('data', 'question'));
    }

    public function updateAnswer(Request $request)
    {
        $data = $request->session()->get('data');
        $this->question->updateAnswer($data);
        return redirect()->route('admin.question.index');
    }

}

