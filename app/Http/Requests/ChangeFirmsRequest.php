<?php

namespace odbh\Http\Requests;


class ChangeFirmsRequest extends Request
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
        $id = $this->segment(4);

        if($id == 0){
            $data = [
                'number_change'=> 'required|numeric|min:1',
                'date_change'=> 'required|date_format:d.m.Y',

                'date_edition'=> 'required|date_format:d.m.Y|after:date_change',
                'date_licence_max'=>'before:date_edition',

                'list_name' => 'required',
                'address' => 'required|min:3|max:50|cyrillic_with',
                'owner' => 'required|min:3|max:50|cyrillic',
                'gender' => 'required',
                'pin' => 'required|pin_validate|digits_between:9,10',

                'phone' => 'phone_validate',
                'mobil' => 'mobile_validate',
                'email' => 'email',

                'user_change' => 'required',
                'active' => 'required',

                'error' => 'in:0'
            ];
        }
        if($id > 0) {
            $data = [
                'list_name' => 'required',
                'address' => 'required|min:3|max:50|cyrillic_with',
                'owner' => 'required|min:3|max:50|cyrillic',
                'gender' => 'required',
                'pin' => 'required|pin_validate|digits_between:9,10',

                'phone' => 'phone_validate',
                'mobil' => 'mobile_validate',
                'email' => 'email',

                'user_change' => 'required',
                'active' => 'required',

                'error' => 'in:0'
            ];
        }

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
        $id = $this->segment(4);
        if($id == 0) {
            $data = [
                'number_change.required' => 'Номера на Заявлението е здължителен!',
                'number_change.numeric' => 'За номер на Заявлението използвай само цифри!',
                'number_change.min' => 'Номера на Заявлението не може да е нула - 0!',
                'date_change.required' => 'Дата на Заявлението е здължителна!',
                'date_change.date_format' => 'Непозволен формат за Дата на Заявление!',

                'date_edition.required' => 'Датата на Издание е здължителна!',
                'date_edition.date_format' => 'Непозволен формат за Дата на Издание!',
                'date_edition.after' => 'Дата на Издание не може да е преди или една и съща с Датата на Зявлението!',

                'date_licence_max.before' => 'ВНИМАНИЕ ПРОВЕРИ ОБЕКТИТЕ! Има обект с Удостоверение или Издание с по-късна дата от избраната. Промяната трябва да бъде след тази дата!',

                'list_name.required' => 'Избери населено място от списъка!',

                'address.required' => 'Попълни адреса на фирмата!',
                'address.min' => 'Минимален брой символи за адрес - 3!',
                'address.max' => 'Минимален брой символи за адрес - 50!',
                'address.cyrillic_with' => 'Пиши само на кирилица!!',

                'owner.required' => 'Попълни името на представителя!',
                'owner.min' => 'Минимален брой символи за име - 3!',
                'owner.max' => 'Минимален брой символи за име - 50!',
                'owner.cyrillic' => 'Пиши само на кирилица!!',

                'pin.required' => 'Попълни ЕГН!',
                'pin.pin_validate' => 'ЕГН-то не отговаря! Виж дали правилно са попълнени данните!',
                'pin.digits_between' => 'ЕГН-то е само цифри!',

                'gender.required' => 'Маркирай дали е мъж или жена!',

                'phone.phone_validate' => 'Некоректен формат на изписване на телефон.',
                'mobil.mobile_validate' => 'Некоректен формат на изписване на мобилен телефон.',

                'email.email' => 'Некоректен формат на електроната поща!',
                'error.in' => 'Избери населено място от списъка! Виж да не е избрана друга община!',

                'user_change.required' => 'Избери инспектора обработил документите!',
                'active.required' => 'Задължително маркирай дали е Действащ обекта!',
            ];
        }
        if($id > 0) {
            $data = [
                'list_name.required' => 'Избери населено място от списъка!',

                'address.required' => 'Попълни адреса на фирмата!',
                'address.min' => 'Минимален брой символи за адрес - 3!',
                'address.max' => 'Минимален брой символи за адрес - 50!',
                'address.cyrillic_with' => 'Пиши само на кирилица!!',

                'owner.required' => 'Попълни името на представителя!',
                'owner.min' => 'Минимален брой символи за име - 3!',
                'owner.max' => 'Минимален брой символи за име - 50!',
                'owner.cyrillic' => 'Пиши само на кирилица!!',

                'pin.required' => 'Попълни ЕГН!',
                'pin.pin_validate' => 'ЕГН-то не отговаря! Виж дали правилно са попълнени данните!',
                'pin.digits_between' => 'ЕГН-то е само цифри!',

                'gender.required' => 'Маркирай дали е мъж или жена!',

                'phone.phone_validate' => 'Некоректен формат на изписване на телефон.',
                'mobil.mobile_validate' => 'Некоректен формат на изписване на мобилен телефон.',

                'email.email' => 'Некоректен формат на електроната поща!',
                'error.in' => 'Избери населено място от списъка! Виж да не е избрана друга община!',

                'user_change.required' => 'Избери инспектора обработил документите!',
                'active.required' => 'Задължително маркирай дали е Действащ обекта!',
            ];
        }
        return $data;
    }
}
