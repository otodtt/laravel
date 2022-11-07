<?php

namespace odbh\Http\Requests;

use odbh\NoneProtocol;
use odbh\Protocol;

class SampleTorRequest extends Request
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

        $protocol_none = NoneProtocol::where('number','=',(int)$request['number_sample'])
            ->where('date_protocol','=',strtotime($request['date_number']))
            ->get();

        if(count($protocol) == 0 && count($protocol_europe) == 0 && count($protocol_none) == 0){
            $data = [
                'number_sample' => 'required|numeric|not_in:'.$request['number_sample'],
                'date_number' => 'required|date_format:d.m.Y',
                'state' => 'numeric',
                'maker' => 'min:3|max:50|cyrillic_with',
                'packaged' => 'min:3|max:50|cyrillic_with',
                'eo' => 'required',
                'name' => 'required|min:2|max:50',
                'active_subs' => 'required|min:2|max:50',
                'lot_number' => 'required',
                'date_lot' => 'date_format:d.m.Y',
                'volume' => 'required|my_numeric',
                'volume_lot' => 'required',
                'results' => 'min:2|max:150|cyrillic_with',
            ];
        }
        else{
            $data = [
                'number_sample' => 'required|numeric',
                'date_number' => 'required|date_format:d.m.Y',
                'state' => 'required',
                'maker' => 'min:3|max:50|cyrillic_with',
                'packaged' => 'min:3|max:50|cyrillic_with',
                'eo' => 'required',
                'name' => 'required|min:2|max:50',
                'active_subs' => 'required|min:2|max:50',
                'lot_number' => 'required',
                'date_lot' => 'date_format:d.m.Y',
                'volume' => 'required|my_numeric',
                'volume_lot' => 'required',
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

        $protocol_none = NoneProtocol::where('number','=',(int)$request['number_sample'])
            ->where('date_protocol','=',strtotime($request['date_number']))
            ->get();

        if(count($protocol) == 0 && count($protocol_europe) == 0 && count($protocol_none) == 0){
            $data = [
                'number_sample.required' => 'Номера на Протокола е Задължителен!',
                'number_sample.numeric' => 'За Номер на Протокол използвай само цифри!',
                'number_sample.not_in' => 'Не е намерен Констативн Протокол с този номер и дата!
                        Провери номера и датата на протокола или първо създай
                        Протокола и след това редактирай пробата!',

                'date_number.required' => 'Датата на Протокола е Задължителна!',
                'date_number.date_format' => 'Не позволен формат за Датата на Протокол!',

                'state.required' => 'Маркирай дали тора е в насипно състояние или е опакован !',

                'maker.min' => 'Минимален брой символи за Име на производител - 3!',
                'maker.max' => 'Максимален брой символи за Име на производител - 50!',
                'maker.cyrillic_with' => 'За Име на производител - пиши на кирилица!',

                'packaged.min' => 'Минимален брой символи за Име на преопаковчик - 3!',
                'packaged.max' => 'Максимален брой символи за Име на преопаковчик - 50!',
                'packaged.cyrillic_with' => 'За Име на преопаковчик - пиши на кирилица!',

                'eo.required' => 'Маркирай дали има маркировка ЕО ТОР!',

                'name.required' => 'Името на Продукта е задължително!',
                'name.min' => 'Минимален брой символи за Име на продукта - 2!',
                'name.max' => 'Максимален брой символи за Име на продукта - 50!',

                'active_subs.required' => 'Напиши съдържанието на хранителни вещества!',
                'active_subs.min' => 'Минималения брой символи за Съдържание на хранителни вещества - 2!',
                'active_subs.max' => 'Максимален брой символи за Съдържание на хранителни вещества - 50!',

                'type_formula.required' => 'Маркирай дали продукта е теченили прахообразен/гранулиран!',
                'type_volume.required' => 'Маркирай дали са килогрма или литра!',

                'lot_number.required' => 'Попълни номер на Партида!',
                'date_lot.date_format' => 'Не позволен формат за Датата на Производство!',

                'volume.required' => 'Попълни количеството на партидата!',
                'volume.my_numeric' => 'За количеството на партидата използвай само цифри или положителни числа!',

                'volume_lot.required' => 'Маркирай килограм, тон или литър!',

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

                'state.required' => 'Маркирай дали тора е в насипно състояние или е опакован !',

                'maker.min' => 'Минимален брой символи за Име на производител - 3!',
                'maker.max' => 'Максимален брой символи за Име на производител - 50!',
                'maker.cyrillic_with' => 'За Име на производител - пиши на кирилица!',

                'packaged.min' => 'Минимален брой символи за Име на преопаковчик - 3!',
                'packaged.max' => 'Максимален брой символи за Име преопаковчик - 50!',
                'packaged.cyrillic_with' => 'За Име на преопаковчик - пиши на кирилица!',

                'eo.required' => 'Маркирай дали има маркировка ЕО ТОР!',

                'name.required' => 'Името на Продукта е задължително!',
                'name.min' => 'Минимален брой символи за Име на продукта - 2!',
                'name.max' => 'Максимален брой символи за Име на продукта - 50!',

                'active_subs.required' => 'Напиши съдържанието на хранителни вещества!',
                'active_subs.min' => 'Минималения брой символи за Съдържание на хранителни вещества - 2!',
                'active_subs.max' => 'Максимален брой символи за Съдържание на хранителни вещества - 50!',

                'type_formula.required' => 'Маркирай дали продукта е теченили прахообразен/гранулиран!',
                'type_volume.required' => 'Маркирай дали са килогрма или литра!',

                'lot_number.required' => 'Попълни номер на Партида!',
                'date_lot.date_format' => 'Не позволен формат за Датата на Производство!',

                'volume.required' => 'Попълни количеството на партидата!',
                'volume.my_numeric' => 'За количеството на партидата използвай само цифри или положителни числа!',

                'volume_lot.required' => 'Маркирай килограм, тон или литър!',

                'results.min' => 'Минимален брой символи за Резултат от Пробата - 2!',
                'results.max' => 'Максимален брой символи за Резултат от Пробата - 150!',
                'results.cyrillic_with' => 'Резултат от Пробата - пиши на кирилица!',
            ];
        }
        return $data;
    }
}
