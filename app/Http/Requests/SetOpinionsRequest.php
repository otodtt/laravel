<?php

namespace odbh\Http\Requests;


class SetOpinionsRequest extends Request
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
            'full_name'=>'required|cyrillic_with|min:3',
            'short_name'=>'required|cyrillic_with|min:3',
            'show_rate'=>'required',
            'period'=>'required|not_in:0',
        ];
    }

    /**
     * Проверка на входящите данни и мои съобщения
     * @return array
     */
    public function messages()
    {
        return [
            'full_name.min' => 'Минимален брой символи - 3!',
            'full_name.required' => 'Напиши пълното име на Мярката!',
            'full_name.cyrillic_with' => 'Напиши името на кирилица!',

            'short_name.max' => 'Максимален брой символи - 3!',
            'short_name.required' => 'Напиши кратко име на Мярката!',
            'short_name.cyrillic_with' => 'Напиши краткото име на кирилица!',

            'show_rate.required' => 'Маркирай дали мярката да се показва!',

            'period.required' => 'Избери периода на действие на мярката!',
            'period.not_in' => 'Избери периода на действие на мярката!',
        ];
    }
}
