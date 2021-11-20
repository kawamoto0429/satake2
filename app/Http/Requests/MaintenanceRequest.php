<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaintenanceRequest extends FormRequest
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
            'name'=>'required',
            'price_1pc'=>'required',
            'price_10pcs'=>'required',
            'price_30pcs'=>'required',
            'jan'=>'required',
            'maker_id'=>'required',
            'category_id'=>'required',
            'genre_id'=>'required',
            'lot'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'商品名を入力してください',
            'price_1pc.required'=>'個数を入力してください',
            'price_10pcs.required'=>'個数を入力してください',
            'price_30pcs.required'=>'個数を入力してください',
            'jan.required'=>'JANコードを入力してください',
            'maker_id.required'=>'メーカーを選択してください',
            'category_id.required'=>'カテゴリーを選択してください',
            'genre_id.required'=>'ジャンルを選択してください',
            'lot.required'=>'入数を入力してください',
        ];
    }
}
