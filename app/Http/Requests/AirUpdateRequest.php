<?php

namespace odbh\Http\Requests;

//use odbh\Http\Requests\Request;

use odbh\Air;

class AirUpdateRequest extends Request
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
        $data = null;

        $id = $this->segment(3);
        $permit = Air::findOrFail($id);
        $date_permit = date('d.m.Y', $permit->date_permit);

        $data = [
            'number_petition'=> 'required|numeric|min:1',
            'date_petition'=>'required|date_format:d.m.Y|before:'.$date_permit,

            'start_date'=>'required|date_format:d.m.Y|after:'.$date_permit,
            'end_date'=>'required|date_format:d.m.Y|after:start_date',

            'ground'=>'required|min:3|max:2500|cyrillic_with',
            'cultivation'=>'required|min:3|max:1500|cyrillic_with',
            'acres'=>'required|numeric|min:1',

            'pest'=>'required|min:3|max:1000|cyrillic_with',
            'prz'=>'required|min:3|max:1500|cyrillic_with',
            'dose'=>'required|min:3|max:1500',
            'quarantine'=>'required|numeric|min:0',

            'agronomist'=>'required|min:3|max:500|cyrillic_with',
            'certificate'=>'required|min:3|max:50|cyrillic_with',

            'inspector'=> 'required|not_in:0',

            'invoice'=> 'required|numeric|min:1',
            'date_invoice'=> 'required|date_format:d.m.Y',
        ];
        return $data;
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
            'number_petition.required' => 'Номера на Заявлението е здължителен!',
            'number_petition.numeric' => 'За номер на Заявлението използвай само цифри!',
            'number_petition.min' => 'Номера на Заявлението не може да е нула - 0!',

            'date_petition.required' => 'Дата на Заявлението е здължителна!',
            'date_petition.date_format' => 'Непозволен формат за Дата на Заявление!',
            'date_petition.before' => 'Датата на Заявление не може да е преди Датата на Разрешителното!',

            'start_date.required' => 'Началната Дата е здължителна!',
            'start_date.date_format' => 'Непозволен формат за Начална Дата!',
            'start_date.after' => 'Началната Дата не може да е преди Датата на Разрешителното!',

            'end_date.required' => 'Крайната Дата е здължителна!',
            'end_date.date_format' => 'Непозволен формат за Крайна Дата!',
            'end_date.after' => 'Крайната Дата не може да е преди Началната Дата!',

            'ground.required' => 'Опиши населените места и менсности!',
            'ground.min' => 'Минимален брой символи за населени места и месности - 3!',
            'ground.max' => 'Минимален брой символи за населени места и месности - 2500!',
            'ground.cyrillic_with' => 'Населени места и месности - Пиши само на кирилица!',

            'cultivation.required' => 'Опиши културата която ще се третира!',
            'cultivation.min' => 'Минимален брой символи за културата - 3!',
            'cultivation.max' => 'Минимален брой символи за културата - 1500!',
            'cultivation.cyrillic_with' => 'Третирани култури - Пиши само на кирилица!',

            'acres.required' => 'Попълни декарите!',
            'acres.numeric' => 'За декари използвай само цифри!',
            'acres.min' => 'За декари не може да е нула или отрицателно число!',

            'pest.required' => 'Опиши вредителите!',
            'pest.min' => 'Минимален брой символи за вредител - 3!',
            'pest.max' => 'Минимален брой символи за вредител - 1000!',
            'pest.cyrillic_with' => 'За вредител - Пиши само на кирилица!',

            'prz.required' => 'Опиши използваните продукти!',
            'prz.min' => 'Минимален брой символи за ПРЗ - 3!',
            'prz.max' => 'Минимален брой символи за ПРЗ - 1500!',
            'prz.cyrillic_with' => 'За ПРЗ - Пиши само на кирилица!',

            'dose.required' => 'Опиши дозите на използваните продукти!',
            'dose.min' => 'Минимален брой символи за доза - 3!',
            'dose.max' => 'Минимален брой символи за доза - 1500!',

            'quarantine.required' => 'Попълни карантиния период! Ако няма такъв напиши - нула (0)',
            'quarantine.numeric' => 'За карантиния период използвай само цифри!',
            'quarantine.min' => 'За карантинен период не може да е отрицателно число!',

            'agronomist'=>'required|min:3|max:500|cyrillic_with',
            'certificate'=>'required|min:3|max:50|cyrillic_with',
            'inspector'=> 'required|not_in:0',

            'agronomist.required' => 'Попълни имената на агронома дал предписанието!',
            'agronomist.min' => 'Минимален брой символи за име агроном - 3!',
            'agronomist.max' => 'Минимален брой символи за име агроном - 500!',
            'agronomist.cyrillic_with' => 'За име на агроном - Пиши само на кирилица!',

            'certificate.required' => 'Попълни Сертификата на агронома дал предписанието!',
            'certificate.min' => 'Минимален брой символи за Сертификат - 3!',
            'certificate.max' => 'Минимален брой символи за Сертификат - 500!',
            'certificate.cyrillic_with' => 'За Сертификат - Пиши само на кирилица!',

            'inspector.required'=> 'Избери инспектора обработил документите!',
            'inspector.not_in'=> 'Избери инспектора обработил документите!',

            'invoice.required' => 'Номера на Фактурата е здължителен!',
            'invoice.numeric' => 'За номер на Фактура използвай само цифри!',
            'invoice.min' => 'Номера на Фактурата не може да е нула - 0 или отрицателно число!',
            'date_invoice.required' => 'Дата на Фактурата е здължителна!',
            'date_invoice.date_format' => 'Непозволен формат за Дата на Фактура!',
        ];
        return $data;
    }
}
