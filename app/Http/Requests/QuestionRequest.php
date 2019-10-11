<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //アクセス元のパスをチェック
        if($this->path() == 'question' || 'questionForm') {
            return true;
        } else {
            return false;
        }
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
            'title' => 'required',
            'category' => 'required',
            'body' => 'required'
        ];    
    }

    public function messages()
    {
        return [
            'title.required' => '※※タイトルは必ず入力してください※※',
            'category.required' => '※※カテゴリーは必ず入力してください※※',
            'body.required' => '※※内容は必ず入力してください※※'
        ];
    }
}
