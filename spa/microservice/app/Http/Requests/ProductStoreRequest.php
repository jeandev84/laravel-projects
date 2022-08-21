<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'name'  => 'required|string',
            'price' => 'required|numeric'
        ];
    }


    public function messages()
    {
        return [
            'name.required'   => 'Поле обязательное.',
            'name.string'     => 'Содержимое данного поля должно быть строковое значение.',
            'price.required'  => 'Поле обязательное.',
            'price.numeric'   => 'Содержимое данного поля должно быть целое число.',
        ];
    }
}
