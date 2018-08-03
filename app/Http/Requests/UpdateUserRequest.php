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
            'tel' => 'required',
            'birthday' => 'required',
            'hire_date' => 'required'
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
            'birthday.required' => '入力されていません',
            'hire_date.required' => '入力されていません'
        ];
    }
}
