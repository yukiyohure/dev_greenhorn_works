<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUserEditRequest extends FormRequest
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
            'name' => 'required',
            'last_name' => 'required',
            'first_name' => 'required',
            'sex' => 'required',
            'tel' => 'required|int',
        ];
    }

    public function messages()
    {
      return [
        'name.required' => 'ユーザー名を入力してください',
        'last_name.required' => '名前を入力してください(性)',
        'first_name.required' => '名前を入力してください(名)',
        'sex.required' => '性別を選択してください',
        'tel.required' => '電話番号を入力してください',
        'tel.int' => '電話番号は数字で入力してください',
      ];
    }
}
