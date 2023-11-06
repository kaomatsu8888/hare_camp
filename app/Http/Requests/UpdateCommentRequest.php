<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array//rulesメソッドを追加
    {
        return [
            'body' => 'required|string|max:200',//bodyに対してのバリデーションルールを追加。必須入力、文字列、最大文字数200
        ];
    }

    public function attributes(): array//attributesメソッドを追加
    {
        return [
            'body' => 'コメント',//bodyのラベルを変更
        ];
    }
}
