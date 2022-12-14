<?php

namespace odbh\Http\Requests;

use odbh\Http\Requests\Request;

class QNewComplianceRequest extends Request
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
        $owner = null;
        $gender_owner = null;
        $pin_owner = null;
        $name = null;
        $name_firm = null;
        $eik = null;

        ///////
        $request = Request::all();

        if(isset($request['firm']) && $request['firm'] == 1){
            $name = 'required|min:3|max:150|cyrillic';
            $gender = 'required';
            $pin = 'required|pin_validate_name|digits_between:9,10|unique:farmers,pin,';

            $eik = '';
            $owner = '';
            $gender_owner = '';
            $pin_owner = '';
            $name_firm = '';
        }
        elseif(isset($request['firm']) && $request['firm'] > 1){
            $name_firm = 'required|min:3|max:150|cyrillic_names';
            $name = '';
            $gender = '';
            $pin = '';

            $eik = 'required|is_valid|digits_between:9,13|unique:farmers,pin|unique:farmers,bulstat,';

            $owner = 'required|min:3|max:100|cyrillic';
            $gender_owner = 'required';

            if(!isset($request['gender_owner']) || strlen($request['gender_owner']) == 1){
                $pin_owner = '';
            } else {
                $pin_owner = 'required|pin_validate_owner|digits_between:9,10';
            }
        }
        else{
            $name = 'required|min:3|max:150|cyrillic_names';
            $gender = 'required';
            $pin = 'required|pin_validate_name|digits_between:9,10';

            $owner = '';
            $gender_owner = '';
            $name_firm = '';
            $pin_owner = '';
        }


        return [
            'firm' => 'required',
            'bulstat' => $eik,
            'name_firm' => $name_firm,
            'owner' => $owner,
            'gender_owner' => $gender_owner,
            'pin_owner' =>$pin_owner,

            'name' => $name,
            'gender' => $gender,
            'pin' => $pin,

            'list_name' => 'required',
            'error' => 'in:0',

            'address'=> 'required|min:3|max:100|cyrillic_with',
            'phone'=> 'phone_validate',
            'mobil'=> 'mobile_validate',
            'email'=> 'email',

            'district_object' => 'required|not_in:0',
            'location_farm' => 'min:3|max:50|cyrillic_names_objects',

            'date_compliance' => 'required|date_format:d.m.Y',
            'object_control'=>'required|cyrillic_with|min:3|max:500',
            'name_trader'=>'required|cyrillic_with|min:3|max:500',
            'notes' => 'required',
            'inspectors' => 'required|not_in:0'
        ];
    }

    /**
     * Мои съобщения за грешки.
     *
     * @return array
     */
    public function messages() {
        $data = [
            'firm.required' => 'Маркирай вида на фирмата или ЧЗС!',
            'name.required' => 'Попълни името на фирмата/ЧЗС!',
            'name.min' => 'Минимален брой символи за името - 3!',
            'name.max' => 'Минимален брой символи за името - 100!',
            'name.cyrillic' => 'За име на ЧЗС пиши само на кирилица без символи! Позволени символи: (тире - )!',

            'name_firm.required' => 'Попълни името на фирмата/ЧЗС!',
            'name_firm.min' => 'Минимален брой символи за името - 3!',
            'name_firm.max' => 'Минимален брой символи за името - 100!',
            'name_firm.cyrillic_names' => 'За име на фирмата пиши само на кирилица без символи! Позволени символи: (тире - ) и цифри!',

            'gender.required'=>'Маркирай "Мъж" или "Жена"!',
            'pin.required' => 'Попълни ЕГН!',
            'pin.pin_validate_name' => 'ЕГН-то не отговаря! Виж дали правилно са попълнени данните!',
            'pin.digits_between' => 'ЕГН-то е само цифри!',
            'pin.unique' => 'ЕГН-то трябва да е уникално! Намерен е запис с това ЕГН!',

            'bulstat.required' => 'Булстата е задължителен!',
            'bulstat.digits_between' => 'Булстата е само с цифри! Минимален брой символи - 9',
            'bulstat.unique' => 'Булстата трябва да е уникален! Намерена е фирма с този БУЛСТАТ',
            'bulstat.is_valid' => 'Невалиден БУЛСТАТ! Виж дали правилно е попълнен!',

            'owner.required' => 'Попълни име на Управител/Представител!',
            'owner.min' => 'Минимален брой символи за име на Представител - 3!',
            'owner.max' => 'Максимален брой символи за име на Представител - 100!',
            'owner.cyrillic' => 'За име на Представител - Пиши само на кирилица без символи!',

            'gender_owner.required' => 'За Управител маркирай  дали е мъж или жена! Ако не се знае ЕГН-то, маркирай - "Без ЕГН" ',

            'pin_owner.required' => 'Попълни ЕГН на Представител или маркирай - "Без ЕГН"!',
            'pin_owner.pin_validate_owner' => 'ЕГН-то на Представител не отговаря! Виж дали правилно са попълнени данните!',
            'pin_owner.digits_between' => 'ЕГН-то е само цифри!',

            'list_name.required' => 'Избери населено място от списъка!',

            'address.required' => 'Адреса е задължителен!',
            'address.min' => 'За Адреса минимален брой символи - 3!',
            'address.max' => 'За Адреса максимале брой символи - 500!',
            'address.cyrillic_with' => 'За Адреса пиши на кирилица!',

            'phone.phone_validate' => 'Непозволен формат на телефонния номер!',
            'mobil.mobile_validate' => 'Непозволен формат на мобилния номер!',
            'email.email' => 'Непозволен формат на електронен адрес!',

            'district_object.required' => 'Задължително избери Общината където се намира стопанството!',
            'district_object.not_in' => 'Задължително избери Общината където се намира стопанството!',

            'location_farm.min' => 'Минимален брой символи за Населено място\места - 3!',
            'location_farm.max' => 'Минимален брой символи за Населено място\места - 50!',
            'location_farm.cyrillic_names_objects' => 'За Населено място\места пиши на кирилица без символи! Позволени символи (точка, запетая, точка и запетая) - . , ;',

            'error.in' => 'Избери населено място от списъка! Виж да не е избрана друга община!',

            'date_compliance.required' => 'Датата на Формуляра е здължителна!',
            'date_compliance.date_format' => 'Непозволен формат за Дата на Формуляр!',

            'object_control.required' => 'Попълни Обекта на контрол!',
            'object_control.cyrillic_with' => 'За Обекта на контрол използвай кирилица без символите ( )!',
            'object_control.min' => 'За Обекта на контрол - минимален брой символи - 3!',
            'object_control.max' => 'За Обекта на контрол - максимален брой символи - 500!',

            'name_trader.required' => 'Попълни Трите имена на търговеца или на негов представител!',
            'name_trader.cyrillic_with' => 'За Трите имена на търговеца или на негов представител използвай кирилица без символите ( )!',
            'name_trader.min' => 'За Трите имена на търговеца или на негов представитела - минимален брой символи - 3!',
            'name_trader.max' => 'За Трите имена на търговеца или на негов представител - максимален брой символи - 500!',

            'notes.required' => 'Попълни дали отговаря на изискванията за качество!',

            'inspectors.required' => 'Избери инспектора извършил проверката!',
            'inspectors.not_in' => 'Избери инспектора извършил проверката!',

        ];
        return $data;
    }
}
