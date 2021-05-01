<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'title' => 'required|max:100',
            'content' => 'required|max:100',
            'person_in_charge' => 'required|max:100'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'タイトルは必須項目です。',
            'title.max' => 'タイトルは100文字以内で入力してください。',
            'content.required' => 'コンテンツは必須項目です。',
            'content.max' => 'コンテンツは100文字以内で入力してください。',
            'person_in_charge.required' => '更新者は必須項目です。',
            'person_in_charge.max' => '更新者は100文字以内で入力してください。',
        ];
    }
}
