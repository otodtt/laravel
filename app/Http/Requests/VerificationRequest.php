<?php

namespace odbh\Http\Requests;


class VerificationRequest extends Request
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
            'short_name'=>'required|min:3',
            'type_check'=>'required',
            'show_check'=>'required',
        ];
    }

    /**
     * Мои съобщения за грешки.
     * @return array
     */
    public function messages()
    {
        return [
            'full_name.min' => 'Минимален брой символи - 3!',
            'full_name.required' => 'Напиши пълното име на Проверката!',
            'full_name.cyrillic_with' => 'Напиши името на кирилица!',

            'short_name.max' => 'Максимален брой символи - 3!',
            'short_name.required' => 'Напиши кратко име на Проверката!',

            'type_check.required' => 'Маркирай вида на Проверката!',
            'show_check.required' => 'Маркирай дали да се показва или не!',
        ];
    }
}
