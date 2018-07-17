<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccessRightRequest extends FormRequest
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
        'authorizer_id' => 'required',
        'message' => 'required|max:2000'
      ];
    }

    public function messages()
    {
      return [
        'authorizer_id.required' => '承認者を選択してください',
        'message.max' => '1000文字を超えないでください',
        'message.required' => 'メッセージを記入してください'
      ];
    }
}
