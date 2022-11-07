<?php

namespace odbh\Http\Requests;

use odbh\Repository;

class ChangeRepositoriesRequest extends Request
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
        $type_ru = Repository::findOrFail($id);
        $date_license = date('d.m.Y',$type_ru->date_licence);
        if ($type_ru->raz_udost == 1){
            $data = [
                'active'=> 'required',
                'number_change'=> 'numeric|required|not_in:0',

                'date_change'=> 'date_format:d.m.Y|required|before:date_edition',
                'date_edition'=> 'required|date_format:d.m.Y|after:'.$date_license,
                'localsID'=>'required',
                'list_name'=>'required',
                'address'=> 'required|min:3|max:50|cyrillic_with',
                'error'=>'in:0'
            ];
        }
        if($type_ru->raz_udost == 2) {
            $data = [
                'active'=> 'required',

                'number_change'=> 'required|numeric|not_in:0',
                'date_change'=> 'required|date_format:d.m.Y|before:date_edition',

                'date_edition'=> 'required|date_format:d.m.Y|after:'.$date_license,

                'localsID'=>'required',
                'list_name'=>'required',
                'address'=> 'required|min:3|max:50|cyrillic_with',

                'seller'=> 'required|min:3|max:50|cyrillic',
                'index_certificate'=> 'required',
                'certificate'=> 'required|numeric|not_in:0',
                'date_certificate'=> 'required|date_format:d.m.Y',

                'user_change'=> 'required',
                'error'=>'in:0'
            ];
        };

        return $data;
    }

    /**
     * Мои съобщения за грешка
     * @return array|null
     */
    public function messages()
    {
        $data = null;
        $id = $this->segment(3);
        $type_ru = Repository::findOrFail($id);

        if ($type_ru->raz_udost == 1){
            $data = [
                'active.required' => 'Задължително маркирай дали е Действащ обекта!',

                'number_change.required' => 'Номера на Заявлението е здължителен!',
                'number_change.numeric' => 'За Номер на Заявлението използвай само цифри!',
                'number_change.not_in' => 'Номера на Заявлението не може да е нула - 0',

                'date_change.required' => 'Датата на Заявлението е здължителна!',
                'date_change.date_format' => 'Непозволен формат за Дата на Разрешителното!',
                'date_change.before' => 'Датата на Заявлението не може да е след датата на Издание!
                Поне един ден преди датата на Издание.',

                'date_edition.required' => 'Датата на Издание е здължителна!',
                'date_edition.date_format' => 'Непозволен формат за Дата на Издание!',
                'date_edition.after' => 'ВНИМАНИЕ! Датата на Издане за Промяна не може да е
                Преди датата на Разрещителното или Удостоверението!',

                'localsID.required' => 'Избери общината където е регистрирана Аптеката!',
                'list_name.required' => 'Избери населено място от списъка!',

                'address.required' => 'Попълни адреса на Аптеката!',
                'address.min' => 'Минимален брой символи за адрес - 3!',
                'address.max' => 'Минимален брой символи за адрес - 50!',
                'address.cyrillic_with' => 'За Адреса използвай само на кирилица!!',

                'error.in' => 'Избери първо общината и после населеното място! Виж да не е избрана друга община!',
            ];
        }
        if($type_ru->raz_udost == 2) {
            $data = [
                'active.required' => 'Задължително маркирай дали е Действащ обекта!',

                'number_change.required' => 'Номера на Заявлението е здължителен!',
                'number_change.numeric' => 'За номер на Заявлението използвай само цифри!',
                'number_change.not_in' => 'Номера на Заявлението не може да е нула - 0',

                'date_change.required' => 'Дата на Заявлението е здължителна!',
                'date_change.date_format' => 'Непозволен формат за Дата на Заявление!',
                'date_change.before' => 'Датата на Заявлението не може да е след датата на Издание!
                Поне един ден преди датата на Издание.',

                'date_edition.required' => 'Датата на Издание е здължителна!',
                'date_edition.date_format' => 'Непозволен формат за Дата на Издание!',
                'date_edition.after' => 'ВНИМАНИЕ! Датата на Издане за Промяна не може да е
                Преди датата на Разрешителното или Удостоверението!',

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

                'user_change.required' => 'Избери инспектора обработил документите!',

                'error.in' => 'Избери първо общината и после населеното място! Виж да не е избрана друга община!',
            ];
        };
        return $data;
    }
}
