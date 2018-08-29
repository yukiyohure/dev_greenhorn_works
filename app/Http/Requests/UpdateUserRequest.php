<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'sex' => [
                'required',
                Rule::in(['男', '女']),
            ],
            'store_id' => 'required|integer|between:1,3',
            'tel' => 'required|numeric|digits:11',
            'birthday' => 'required|date|before:today',
            'hire_date' => 'required|date|after:2015-05-14'
        ];
    }

    public function messages()
    {
        return [
            'sex.required' => '選択してください',
            'sex.in' => '入力が間違っています',
            'store_id.required' => '選択してください',
            'store_id.integer' => '入力が間違っています',
            'store_id.between' => '正しく入力してください',
            'tel.required' => '入力されていません',
            'tel.numeric' => '半角英数で入力してください',
            'tel.digits' => '入力が間違っています',
            'birthday.required' => '入力されていません',
            'birthday.date' => '入力に誤りがあります',
            'birthday.before' => '今日より前の日付を入力してください',
            'hire_date.required' => '入力されていません',
            'hire_date.date' => '入力に誤りがあります',
            'hire_date.after' => '2015/05/15以降の日付を入力してください'
        ];
    }
}
