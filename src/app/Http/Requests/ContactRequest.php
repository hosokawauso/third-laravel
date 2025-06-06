<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'tel' => ['required', 'numeric', 'digits_between:10,11' ]
        ];
    }

    public function messages()
        {
            return [
                'name.required' => '名前を入力してください',
            'name.string'   => '名前を文字列で入力してください',
            'name.max' =>'名前を２５５文字以下で入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.string' => 'メールアドレスを文字列で入力してください',
            'email.email' => '有効なメールアドレス形式で入力してください',
            'email.max' => 'メールアドレスを２５５文字以下で入力してください',
            'tel.required' => '電話番号を入力してください',
            'tel.numeric' => '電話番号は数値で入力してください',
            'tel.digits_between' => '電話番号は１０桁から１１桁の間で入力してください',



            ];
        }
    
}
