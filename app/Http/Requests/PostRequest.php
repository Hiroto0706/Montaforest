<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => 'required|min:3',
            'body' => 'required',
            'image' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'タイトルがありません',
            'title.min' => ':min 文字以上入力してください',
            'body.required' => '本文がありません',
            'image.required' => 'アップロードする画像を選択してください',
        ];
    }
}
