<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Log;

class CategoryRequest extends FormRequest
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
            'name'=>'required,
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'カテゴリーを入力してください',
            'name.max'=>'文字数が制限を超えています',
        ];
        log::debug('name');
    }
}
