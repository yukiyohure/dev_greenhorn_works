<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class users extends FormRequest
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
            'last_name'=>'required|max:11',
            'first_name'=>'required',
//            'sex'=>'required',
//            'birthday'=>'required',
            'email'=>'required',
//            'tel'=>'required|int|max:11'
        ];
    }

    public function messages()
    {
        return [
        'last_name.required'=> '入力必須の項目です！！！！',
        'first_name.required'=>'入力必須の項目です！！！！',
//        'sex.required'=> '入力必須の項目です！！！！',
//        'birthday.required'=>'入力必須の項目です！！！！',
        'email.required'=>'入力必須の項目です！！！！',
//        'tel.required'=>'入力必須の項目です！！！！'
        ];
    }
}
