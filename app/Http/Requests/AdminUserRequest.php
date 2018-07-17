<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUserRequest extends FormRequest
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
            'last_name' => 'required',
            'first_name' => 'required',
            'sex' => 'required',
            'birthday' => 'required',
            'tel' => 'required|int',
            'hire_date' => 'required',
            'email' => 'required|email|unique:user_infos,email',
        ];
    }

    public function messages()
    {
      return [
        'last_name.required' => '名前を入力してください(性)',
        'first_name.required' => '名前を入力してください(名)',
        'sex.required' => '性別を選択してください',
        'birthday.required' => '生年月日を入力してください',
        'tel.required' => '電話番号を入力してください',
        'tel.int' => '電話番号は数字で入力してください',
        'hire_date.required' => '入社日を選択してください',
        'email.required' => 'メールアドレスを入力してください',
        'email.email' => '有効なメールアドレスを入力してください',
        'email.unique' => '既に使用されているメールアドレスです',
      ];
    }
}
