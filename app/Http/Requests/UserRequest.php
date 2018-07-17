<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'last_name'=>'required',
            'first_name'=>'required',
            'sex'=>'required',
            'birthday'=>'required',
            'email'=>'required|email',
            'hire_date'=>'required',
            'tel'=>'required|numeric',
            'store_id'=>'required'
        ];
    }

    public function messages()
    {
        return [
        'last_name.required'=> '必須の項目です！',
        'first_name.required'=>'必須の項目です！',
        'sex.required'=> '必須の項目です！',
        'birthday.required'=>'必須の項目です！',
        'email.required'=>'必須の項目です！',
        'hire_date.required'=> '必須の項目です！',
        'tel.required'=>'必須の項目です！',
        'tel.numeric'=>'数字でお願いします！',
        'store_id.required'=>'必須の項目です！'
        ];
    }
}
