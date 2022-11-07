<?php

namespace odbh\Http\Requests;

use odbh\Http\Requests\Request;

class SetStampRequest extends Request
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
            'q_index' => 'required|max:5',
            'authority_bg' => 'required|cyrillic_with|max:100',
            'authority_en' => 'required|latin|max:100',
        ];
    }

    /**
     * Проверка на входящите данни и мои съобщения
     * @return array
     */
    public function messages()
    {
        return [
            'q_index.required' => 'Въведи индекса на печата!',
            'q_index.max' => 'Максимален брой символи за печата - 5!',

            'authority_bg.required' => 'Името на контролния орган е Задължителено!',
            'authority_bg.cyrillic_with' => 'Името на контролния орган изписано на кирилица!',
            'authority_bg.max' => 'Максимален брой символи за име на контролния орган - 100!',

            'authority_en.required' => 'Името на контролния орган е Задължителено!',
            'authority_en.cyrillic_with' => 'Името на контролния орган изписано на кирилица!',
            'authority_en.max' => 'Максимален брой символи за име на контролния орган - 100!',
        ];
    }
}
