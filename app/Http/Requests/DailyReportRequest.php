<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DailyReportRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'date' => 'required|before:now',
      'title' => 'required|max:30',
      'contents' => 'required|max:250',
    ];
  }

  public function messages()
  {
    return [
      'date.before' => '今日以前の日付を入力してください。',
      'date.required' => '入力必須の項目です。',
      'title.max' => '30文字以内で入力してください。',
      'title.required' => '入力必須の項目です。',
      'contents.max' => '250文字以内で入力してください。',
      'contents.required' => '入力必須の項目です。',
    ];
  }
}
