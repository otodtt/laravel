<?php

namespace odbh\Http\Requests;

use odbh\Http\Requests\Request;

class AirNewRequest extends Request
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
        $owner = null;
        $gender_owner = null;
        $pin_owner = null;
        $name = null;
        $name_firm = null;
        $eik = null;
        $assay_error = null;
        $act = null;
        $violation = null;

        $request = Request::all();
        if(!isset($request['act']) || $request['act'] == 0){
            $violation = 'required';
            $act = 'required_if:violation,1|required';
        }
        if(isset($request['act']) && $request['act'] == 1){
            $violation = 'in:1|required';
            $act = '';
        }
        if(!isset($request['assay_no']) || !isset($request['assay_more']) || !isset($request['assay_prz'])  || !isset($request['assay_tor'])
            || !isset($request['assay_metal']) || !isset($request['assay_micro']) || !isset($request['assay_other'])){
            $assay_error = 'not_in:0';
        }
        else{
            $assay_error = '';
        }
        ///////
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
        $data = [
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

            'address'=> 'required|min:3|max:50|cyrillic_with',
            'phone'=> 'phone_validate',
            'mobil'=> 'mobile_validate',
            'email'=> 'email',

            'district_object' => 'required|not_in:0',
            'location_farm' => 'min:3|max:50|cyrillic_names_objects',


            'number_permit'=> 'required|numeric|min:1',
            'date_permit'=> 'required|date_format:d.m.Y',

            'number_petition'=> 'required|numeric|min:1',
            'date_petition'=>'required|date_format:d.m.Y|before:date_permit',

            'start_date'=>'required|date_format:d.m.Y|after:date_permit',
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

            'district_object.required' => 'Задължително избери Общината където се намира стопанството!',
            'district_object.not_in' => 'Задължително избери Общината където се намира стопанството!',

            'location_farm.min' => 'Минимален брой символи за Населено място\места - 3!',
            'location_farm.max' => 'Минимален брой символи за Населено място\места - 50!',
            'location_farm.cyrillic_names_objects' => 'За Населено място\места пиши на кирилица без символи! Позволени символи (точка, запетая, точка и запетая) - . , ;',

            'error.in' => 'Избери населено място от списъка! Виж да не е избрана друга община!',


            'number_permit.required' => 'Номера на Разрешителното е здължителен!',
            'number_permit.numeric' => 'За номер на Разрешително използвай само цифри!',
            'number_permit.min' => 'Номера на Разрешителното не може да е нула - 0 или отрицателно число!',
            'date_permit.required' => 'Дата на Разрешителното е здължителна!',
            'date_permit.date_format' => 'Непозволен формат за Дата на Разрешително!',

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
