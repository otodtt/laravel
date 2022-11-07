<?php

namespace odbh\Http\Requests;

use odbh\Workshop;

class WorkshopUpdateRequest extends Request
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
        $id = $this->segment(2);
        $type_ru = Workshop::findOrFail($id);
        if ($type_ru->raz_udost == 1){
            $data = [
                'active'=> 'required',
                'number_licence'=> 'required|numeric|not_in:0',
                'date_licence'=> 'required|date_format:d.m.Y',
                'localsID'=>'required',
                'list_name'=>'required',
                'address'=> 'required|min:3|max:50|cyrillic_with',
                'error'=>'in:0'
            ];
        } elseif($type_ru->raz_udost == 2) {
            $data = [
                'active'=> 'required',

                'number_petition'=> 'required|numeric|not_in:0',
                'date_petition'=> 'required|date_format:d.m.Y|before:date_licence',

                'number_licence'=> 'required|numeric|not_in:0',
                'date_licence'=> 'required|date_format:d.m.Y|after:01.01.2014',

                'localsID'=>'required',
                'list_name'=>'required',
                'address'=> 'required|min:3|max:50|cyrillic_with',

                'seller'=> 'required|min:3|max:50|cyrillic',
                'index_certificate'=> 'required',
                'certificate'=> 'required|numeric|not_in:0',
                'date_certificate'=> 'required|date_format:d.m.Y',

                'inspector'=> 'required',
                'error'=>'in:0'
            ];
        };
        return $data;
    }

    /**
     * Мои съобщения за грешки.
     *
     * @return array|null
     */
    public function messages()
    {
        $data = null;
        $id = $this->segment(2);
        $type_ru = Workshop::findOrFail($id);
        if ($type_ru->raz_udost == 1){
            $data = [
                'active.required' => 'Задължително маркирай дали е Действащ обекта!',

                'number_licence.required' => 'Номера на Разрешителното е здължителен!',
                'number_licence.numeric' => 'За Номер на Разрешителното използвай само цифри!',
                'number_licence.not_in' => 'Номера на Разрешителното не може да нула - 0!',

                'date_licence.required' => 'Датата на Разрешителното е здължителна!',
                'date_licence.date_format' => 'Непозволен формат за Дата на Разрешителното!',

                'localsID.required' => 'Избери общината където е регистрирана Аптеката!',
                'list_name.required' => 'Избери населено място от списъка!',

                'address.required' => 'Попълни адреса на Аптеката!',
                'address.min' => 'Минимален брой символи за адрес - 3!',
                'address.max' => 'Минимален брой символи за адрес - 50!',
                'address.cyrillic_with' => 'За Адреса използвай само на кирилица!!',

                'error.in' => 'Избери първо общината и после населеното място! Виж да не е избрана друга община!',
            ];
        } elseif($type_ru->raz_udost == 2) {
            $data = [
                'active.required' => 'Задължително маркирай дали е Действащ обекта!',

                'number_petition.required' => 'Номера на Заявлението е здължителен!',
                'number_petition.numeric' => 'За номер на Заявлението използвай само цифри!',
                'number_petition.not_in' => 'Номера на Заявлението не може да нула - 0!',

                'date_petition.required' => 'Дата на Заявлението е здължителна!',
                'date_petition.date_format' => 'Непозволен формат за Дата на Заявление!',
                'date_petition.before' => 'Дата на Удостоверение не може да е преди Датата на Зявлението и поне 1 ден след него!',

                'number_licence.required' => 'Номера на Удостоверението е здължителен!',
                'number_licence.numeric' => 'За Номер на Удостоверение използвай само цифри!',
                'number_licence.not_in' => 'Номера на Удостоверение не може да нула - 0!',

                'date_licence.required' => 'Датата на Удостоверението е здължителна!',
                'date_licence.date_format' => 'Непозволен формат за Дата на Удостоверение!',
                'date_licence.after' => 'Датата на Удостоверение не може да е преди 01.01.2014 г. Преди това не се издавха Удостоверения.',

                'localsID.required' => 'Избери общината където е регистрирана Аптеката!',
                'list_name.required' => 'Избери населено място от списъка!',

                'address.required' => 'Попълни адреса на Аптеката!',
                'address.min' => 'Минимален брой символи за адрес - 3!',
                'address.max' => 'Минимален брой символи за адрес - 50!',
                'address.cyrillic_with' => 'За Адреса използвай само на кирилица!!',

                'seller.required' => 'Попълни името на продавач-консултанта!',
                'seller.min' => 'Минимален брой символи за име на продавач-консултанта - 3!',
                'seller.max' => 'Минимален брой символи за име на продавач-консултанта - 50!',
                'seller.cyrillic' => 'За името на продавач-консултанта използвай само на кирилица!',

                'index_certificate.required' => 'Избери индекса на Сертификата! Службата от която е издаден.',

                'certificate.required' => 'Попълни номера на Сертификата',
                'certificate.numeric' => 'За Номер на Сертификата използвай само цифри!',
                'certificate.not_in' => 'Номер на Сертификата не може да нула 0!',

                'date_certificate.required' => 'Дата на Сертификата е здължителна!',
                'date_certificate.date_format' => 'Непозволен формат за Дата на Сертификат!',

                'inspector.required' => 'Избери инспектора обработил документите!',

                'error.in' => 'Избери първо общината и после населеното място! Виж да не е избрана друга община!',
            ];
        };
        return $data;
    }
}
