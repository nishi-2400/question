<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->path() == 'q-detail') {
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
    public function rules(Request $request)
    {
        
        if ($request->submit == '回答') {
            return [
                'title' => 'required',
                'body' => 'required',
            ];
        } else {
            return [
                'body' => 'required'
            ];
        }
    }

    public function messages()
    {
        return [
            'title.required' => '※※タイトルは必ず入力してください※※',
            'body.required' => '※※内容は必ず入力してください※※',
        ];
    }
}
