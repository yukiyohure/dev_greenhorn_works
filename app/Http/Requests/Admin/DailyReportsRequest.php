<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DailyReportsRequest extends FormRequest
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
        $postData = $this->all();
        return [
            'start-date'  => empty($postData['start-date'])? '' : 'before:now',
            'end-date'    => empty($postData['end-date'])? '' : 'before:now',
        ];
    }

    public function messages()
    {
        return [
            'start-date.before' => '今日以前の日付を入力してください',
            'end-date.before'   => '今日以前の日付を入力してください',
        ];
    }
}
