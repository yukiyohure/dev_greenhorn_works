<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemsRequest extends FormRequest
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
            'item_info' => 'required|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '入力必須の項目です。',
            'item_info.required' => '入力必須の項目です。',
            'item_info.max' => '255文字以内で入力して下さい。',
        ];
    }
}
