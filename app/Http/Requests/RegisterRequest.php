<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name'=>'required',
            'password' => 'required|min:6|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'name.required'=> '必須の項目です！',
            'password.required'=>'必須の項目です！',
            'password.confirmed'=>'パスワードが一致しません！',
            'password.min'=>'パスワードは６ケタ以上でお願いします！'
        ];
    }
}
