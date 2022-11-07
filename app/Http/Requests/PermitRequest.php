<?php

namespace odbh\Http\Requests;


class PermitRequest extends Request
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
            'number_licence'=> 'required|numeric|not_in:0',
            'date_licence'=> 'required|date_format:d.m.Y',
            'localsID'=>'required',
            'list_name'=>'required',
            'address'=> 'required|min:3|max:50|cyrillic_with',
            'error'=>'in:0'
        ];
    }

    /**
     * Мои съобщения за грешки.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'number_licence.required' => 'Номера на Разрешителното е здължителен!',
            'number_licence.numeric' => 'За Номер на Разрешителното използвай само цифри!',
            'number_licence.not_in' => 'Номер на Разрешителното не може да нула - 0!',

            'date_licence.required' => 'Датата на Разрешителното е здължителна!',
            'date_licence.date_format' => 'Непозволен формат за Дата на Разрешителното!',

            'localsID.required' => 'Избери общината където е регистриран Обекта!',
            'list_name.required' => 'Избери населено място от списъка!',

            'address.required' => 'Попълни адреса на Обекта!',
            'address.min' => 'Минимален брой символи за адрес - 3!',
            'address.max' => 'Минимален брой символи за адрес - 50!',
            'address.cyrillic_with' => 'За Адреса използвай само на кирилица!!',

            'error.in' => 'Избери първо общината и после населеното място! Виж да не е избрана друга община!',
        ];
    }
}
