<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeskStoreRequest extends FormRequest
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
        // проверяем на уникальности кроме текущего доски
        // 'name' => 'required|max:255|unique:desks,name,'. $this->desk->id
        // sprintf('required|max:255|unique:desks,name,%s', $this->desk->id)
        return [
            'name' => 'required|max:255|unique:desks,name,'.$this->desk->id
        ];
    }


    // Имя доски уже занято
    // translate default error message where field is unique.
    public function messages()
    {
        return [
            'name.unique' => 'Имя доски должно быть уникальное',
        ];
    }
}
