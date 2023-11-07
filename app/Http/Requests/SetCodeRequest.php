<?php

namespace odbh\Http\Requests;

use odbh\Http\Requests\Request;

class SetCodeRequest extends Request
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
            'operator_index_not' => 'required|latin|min:3|max:3|regex:/^[a-zA-Z]+$/u',
        ];
    }

    /**
     * Проверка на входящите данни и мои съобщения
     * @return array
     */
    public function messages()
    {
        return [
            'operator_index_not.required' => 'Идентификационен код на областа е Задължителен!',
            'operator_index_not.latin' => 'Идентификационен код на областа се изписва на латиница!',
            'operator_index_not.min' => 'Минимален брой символи за Идентификационен код на областа - 3!',
            'operator_index_not.max' => 'Максимален брой символи за Идентификационен код на областа - 3!',
            'operator_index_not.regex' => 'За Идентификационен код на областа използвай само латински букви!',
        ];
    }
}
