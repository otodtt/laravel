<?php

namespace odbh\Http\Requests;

use odbh\Http\Requests\Request;

class CountriesRequest extends Request
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
        $id = $this->segment(3);

        return [
            'EC'=>'required',
            'name_en'=>'required|latin_letters|min:3',
        ];
    }

    /**
     * Проверка на входящите данни и мои съобщения
     * @return array
     */
    public function messages()
    {
        return [
            'EC.required' => 'Избери дали е член на ЕС, кандидат или не!',

            'name.min' => 'Минимален брой символи - 2!',
            'name_en.required' => 'Напиши името на държавата на английски!',
            'name_en.latin_letters' => 'Напиши името на латиница без символи!',
            'name_en.min' => 'Името се изписва с минимум 3 символа!',
        ];
    }
}
