<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:20',
            'company' => 'required|string|max:20',
            'price' => 'required|numeric|max:999',
            'stock' => 'required|integer',
        ];
    }

    public function attributes(){
        return [
            'name' => '商品名',
            'company' => 'メーカー名',
            'price' => '価格',
            'stock' => '在庫数',
        ];
    }

    public function messages() {
        return [
            'name.required' => ':attributeは必須項目です。',
            'name.max' => ':attributeは:max字以内で入力してください。',
            'company.required' => ':attributeは必須項目です。',
            'company.max' => ':attributeは:max字以内で入力してください。',
            'price.required' => ':attributeは必須項目です。',
            'price.max' => ':attributeは:max字以内で入力してください。',
            'stock.required' => ':attributeは必須項目です。',
        ];
    }

}
