<?php

namespace odbh\Http\Requests;

use odbh\Http\Requests\Request;

class PhytoPassportRequests extends Request
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
            'passport'=> 'required|numeric|min:1',
            'date_permit'=> 'required|date_format:d.m.Y',
            'invoice'=> 'required|numeric|min:1',
            'date_invoice'=> 'date_format:d.m.Y',
            'number_petition'=> 'required|numeric|min:1',
            'date_petition'=>'required|date_format:d.m.Y|before:date_permit',

            'is_farmer'=> 'numeric|min:1',
            'is_operator'=> 'numeric|min:1',

            'manufacturer'=> 'required|min:3|max:50|cyrillic_with',
            'city'=> 'required|min:3|max:150|cyrillic_with',
            'address'=> 'min:3|max:150|cyrillic_with',
            'pin'=>'digits_between:9,10',

            'quantity'=> 'required|numeric|min:1',
            'quantity_type'=> 'required|numeric',
            'botanical' => 'required|min:3|max:150',
            'direction' => 'required|min:3|max:150',
            'protected'=> 'required|numeric',
        ];
    }

    /**
     * Мои съобщения за грешка
     *
     * @return array|null
     */
    public function messages()
    {
        $data = null;
        $data = [
            'passport.required' => 'Номера на Паспорта е здължителен!',
            'passport.numeric' => 'За номер на Паспорта използвай само цифри!',
            'passport.min' => 'Номера на Паспорта не може да е нула - 0 или отрицателно число!',
            'date_permit.required' => 'Дата на Паспорта е здължителна!',
            'date_permit.date_format' => 'Непозволен формат за Дата на Паспорта!',

            'invoice.required' => 'Номера на Фактурата е здължителен!',
            'invoice.numeric' => 'За номер на Фактура използвай само цифри!',
            'invoice.min' => 'Номера на Фактурата не може да е нула - 0 или отрицателно число!',
            'date_invoice.date_format' => 'Непозволен формат за Дата на Фактура!',

            'number_petition.required' => 'Номера на Заявлението е здължителен!',
            'number_petition.numeric' => 'За номер на Заявлението използвай само цифри!',
            'number_petition.min' => 'Номера на Заявлението не може да е нула - 0 или отрицателно число!',

            'date_petition.required' => 'Попълни Дата на Заявлението!',
            'date_petition.date_format' => 'Непозволен формат за Дата на Заявлението!',
            'date_petition.before' => 'Дата на Заявлението не може да е след дата на Растителния Паспорт!',


            'is_farmer.numeric' => 'За ID на Земеделския стопанин използвай само цифри!',
            'is_farmer.min' => 'За ID на Земеделския стопанин не може да е нула или отрицателно число!',
            'is_operator.numeric' => 'За връзка към регистъра на Професионалните Оператори използвай само цифри!',
            'is_operator.min' => 'За връзка към регистъра на Професионалните Оператори не може да е нула или отрицателно число!',

            'manufacturer.required' => 'Попълни името на фирмата/ЧЗС!',
            'manufacturer.min' => 'Минимален брой символи за името - 3!',
            'manufacturer.max' => 'Минимален брой символи за името - 100!',
            'manufacturer.cyrillic_with' => 'За име на ЧЗС пиши само на кирилица без символи! Позволени символи: (тире - )!',

            'city.required' => 'Попълни Града!',
            'city.min' => 'Минимален брой символи за Града - 3!',
            'city.max' => 'Минимален брой символи за Града - 150!',
            'city.cyrillic_with' => 'За Града пиши само на кирилица без символи! Позволени символи: (тире - )!',

            'address.min' => 'Минимален брой символи за Адреса - 3!',
            'address.max' => 'Минимален брой символи за Адреса - 150!',
            'address.cyrillic_with' => 'За Града пиши само на кирилица без символи! Позволени символи: (тире - )!',
            'pin.digits_between' => 'ЕГН/ЕИК е само цифри, между 9 и 10 символа!',

            'quantity.required' => 'Попълни Количество!',
            'quantity.numeric' => 'За Количество използвай само цифри!',
            'quantity.min' => 'Количество не може да е нула - 0 или отрицателно число!',
            'quantity_type.required' => 'Избери Мярка! (кг. т. бр.)',

            'botanical.required' => 'Попълни Ботанически вид!',
            'botanical.min' => 'Минимален брой символи за Ботанически вид - 3!',
            'botanical.max' => 'Минимален брой символи за Ботанически вид - 150!',

            'direction.required' => 'Попълни Направление!',
            'direction.min' => 'Минимален брой символи за Направление - 3!',
            'direction.max' => 'Минимален брой символи за Направление - 150!',

            'protected.required' => 'Избери Защитена зона! (да/не.)',
        ];
        return $data;
    }
}
