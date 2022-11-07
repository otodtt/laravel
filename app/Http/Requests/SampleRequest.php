<?php

namespace odbh\Http\Requests;

use odbh\Protocol;

class SampleRequest extends Request
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
        $request = Request::all();

        $protocol = Protocol::where('number','=',(int)$request['number_sample'])
            ->where('date_protocol','=',strtotime($request['date_number']))
            ->get();
        $protocol_europe = Protocol::where('number','=',(int)$request['number_sample'])
            ->where('date_protocol','=',strtotime($request['date_number']. 'Europe/Paris'))
            ->get();

        if(count($protocol) == 0 && count($protocol_europe) == 0){
            $data = [
                'number_sample' => 'required|numeric|not_in:'.$request['number_sample'],
                'date_number' => 'required|date_format:d.m.Y',
                'number_mail' => 'numeric|required_with:date_mail',
                'date_mail' => 'date_format:d.m.Y|required_with:number_mail',
                'maker' => 'required|min:3|max:50|cyrillic_with',
                'tc_sample' => 'required',
                'name' => 'required|min:2|max:50|cyrillic_with',
                'active_subs' => 'required|min:2|max:50',
                'type' => 'required|min:2|max:5|only_cyrillic|alpha',
                'type_formula' => 'required',
                'lot_number' => 'required',
                'volume' => 'required|my_numeric',
                'type_volume' => 'required',
                'volume_pac' => 'required|my_numeric',
                'type_pac' => 'required',
                'results' => 'min:2|max:150|cyrillic_with',
            ];
        }
        else{
            $data = [
                'number_sample' => 'required|numeric',
                'date_number' => 'required|date_format:d.m.Y',
                'number_mail' => 'numeric|required_with:date_mail',
                'date_mail' => 'date_format:d.m.Y|required_with:number_mail',
                'maker' => 'required|min:3|max:50|cyrillic_with',
                'tc_sample' => 'required',
                'name' => 'required|min:2|max:50|cyrillic_with',
                'active_subs' => 'required|min:2|max:50',
                'type' => 'required|min:2|max:5|only_cyrillic|alpha',
                'type_formula' => 'required',
                'lot_number' => 'required',
                'volume' => 'required|my_numeric',
                'type_volume' => 'required',
                'volume_pac' => 'required|my_numeric',
                'type_pac' => 'required',
                'results' => 'min:2|max:150|cyrillic_with',
            ];
        }
        return $data;
    }

    /**
     * Мои съобщения за грешки.
     *
     * @return array
     */
    public function messages()
    {
        $request = Request::all();

        $protocol = Protocol::where('number','=',(int)$request['number_sample'])
            ->where('date_protocol','=',strtotime($request['date_number']))
            ->get();

        $protocol_europe = Protocol::where('number','=',(int)$request['number_sample'])
            ->where('date_protocol','=',strtotime($request['date_number']. 'Europe/Paris'))
            ->get();

        if(count($protocol) == 0 && count($protocol_europe) == 0){
            $data = [
                'number_sample.required' => 'Номера на Протокола е Задължителен!',
                'number_sample.numeric' => 'За Номер на Протокол използвай само цифри!',
                'number_sample.not_in' => 'Не е намерен Констативн Протокол с този номер и дата!
                        Провери номера и датата на протокола или първо създай
                        Протокола и след това редактирай пробата!',

                'date_number.required' => 'Датата на Протокола е Задължителна!',
                'date_number.date_format' => 'Не позволен формат за Датата на Протокол!',

                'number_mail.numeric' => 'За номер на придружително писмо използвай само цифри!',
                'number_mail.required_with' => 'Попълни номера на придружително писмо!',
                'date_mail.date_format' => 'Не позволен формат за Датата на придружително писмо!',
                'date_mail.required_with' => 'Попълни датата на придружително писмо!!',

                'maker.required' => 'Попълни името на производителя/преопаковчика!',
                'maker.min' => 'Минимален брой символи за Име на производител - 3!',
                'maker.max' => 'Максимален брой символи за Име на производител - 50!',
                'maker.cyrillic_with' => 'За Име на производител - пиши на кирилица!',

                'tc_sample.required' => 'Маркирай ТС или Сертификат на производителя!',

                'name.required' => 'Името на Продукта е задължително!',
                'name.min' => 'Минимален брой символи за Име на продукта - 2!',
                'name.max' => 'Максимален брой символи за Име на продукта - 50!',
                'name.cyrillic_with' => 'За Име на продукта използвай само кирилица!',

                'active_subs.required' => 'Напиши Активното вещество!',
                'active_subs.min' => 'Минималения брой символи за Активно вещество - 2!',
                'active_subs.max' => 'Максимален брой символи за Активно вещество - 50!',

                'type.required' => 'Попълни формулацията на продукта!',
                'type.min' => 'Минимален брой символи за Формулация - 2!',
                'type.max' => 'Максимален брой символи за Формулация - 5!',
                'type.only_cyrillic' => 'За Формулация на продукта използвай само кирилица!',
                'type.alpha' => 'За Формулация използвай само букви без цифри!',

                'type_formula.required' => 'Маркирай дали продукта е теченили прахообразен/гранулиран!',
                'type_volume.required' => 'Маркирай дали са килогрма или литра!',

                'lot_number.required' => 'Попълни номер на Партида!',

                'volume.required' => 'Попълни количеството на партидата!',
                'volume.my_numeric' => 'За количеството на партидата използвай само цифри или положителни числа!',

                'volume_pac.required' => 'Попълни обема на опаковката!',
                'volume_pac.my_numeric' => 'За обема на опаковката използвай само цифри или положителни числа!',

                'type_pac.required' => 'Маркирай - мг. мл. кг. л. !',

                'results.min' => 'Минимален брой символи за Резултат от Пробата - 2!',
                'results.max' => 'Максимален брой символи за Резултат от Пробата - 150!',
                'results.cyrillic_with' => 'Резултат от Пробата - пиши на кирилица!',
            ];
        }
        else{
            $data = [
                'number_sample.required' => 'Номера на Протокола е Задължителен!',
                'number_sample.numeric' => 'За Номер на Протокол използвай само цифри!',

                'date_number.required' => 'Датата на Протокола е Задължителна!',
                'date_number.date_format' => 'Не позволен формат за Датата на Протокол!',

                'number_mail.numeric' => 'За номер на придружително писмо използвай само цифри!',
                'number_mail.required_with' => 'Попълни номера на придружително писмо!',
                'date_mail.date_format' => 'Не позволен формат за Датата на придружително писмо!',
                'date_mail.required_with' => 'Попълни датата на придружително писмо!!',

                'maker.required' => 'Попълни името на производителя/преопаковчика!',
                'maker.min' => 'Минимален брой символи за Име на производител - 3!',
                'maker.max' => 'Максимален брой символи за Име на производител - 50!',
                'maker.cyrillic_with' => 'За Име на производител - пиши на кирилица!',

                'tc_sample.required' => 'Маркирай ТС или Сертификат на производителя!',

                'name.required' => 'Името на Продукта е задължително!',
                'name.min' => 'Минимален брой символи за Име на продукта - 2!',
                'name.max' => 'Максимален брой символи за Име на продукта - 50!',
                'name.cyrillic_with' => 'За Име на продукта използвай само кирилица!',

                'active_subs.required' => 'Напиши Активното вещество!',
                'active_subs.min' => 'Минималения брой символи за Активно вещество - 2!',
                'active_subs.max' => 'Максимален брой символи за Активно вещество - 50!',

                'type.required' => 'Попълни формулацията на продукта!',
                'type.min' => 'Минимален брой символи за Формулация - 2!',
                'type.max' => 'Максимален брой символи за Формулация - 5!',
                'type.only_cyrillic' => 'За Формулация на продукта използвай само кирилица!',
                'type.alpha' => 'За Формулация използвай само букви без цифри!',

                'type_formula.required' => 'Маркирай дали продукта е теченили прахообразен/гранулиран!',
                'type_volume.required' => 'Маркирай дали са килогрма или литра!',

                'lot_number.required' => 'Попълни номер на Партида!',

                'volume.required' => 'Попълни количеството на партидата!',
                'volume.my_numeric' => 'За количеството на партидата използвай само цифри или положителни числа!',

                'volume_pac.required' => 'Попълни обема на опаковката!',
                'volume_pac.my_numeric' => 'За обема на опаковката използвай само цифри или положителни числа!',

                'type_pac.required' => 'Маркирай - мг. мл. кг. л. !',

                'results.min' => 'Минимален брой символи за Резултат от Пробата - 2!',
                'results.max' => 'Максимален брой символи за Резултат от Пробата - 150!',
                'results.cyrillic_with' => 'Резултат от Пробата - пиши на кирилица!',
            ];
        }
        return $data;
    }
}
