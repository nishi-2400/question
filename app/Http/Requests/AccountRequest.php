<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
         //バリデーションルール(質問作成/編集)
         return [
            'name' => 'required',
            'mail' => 'required',
            'password' => 'required',
        ];    
    }

    public function messages()
    {
        return [
            'name.required' => '※※ユーザ名は必ず入力してください※※',
            'mail.required' => '※※メールアドレスは必ず入力してください※※',
            'password.required' => '※※パスワードは必ず入力してください※※'
        ];
    }
}
