<?php

namespace odbh\Http\Requests;

use odbh\Http\Requests\Request;

class QNewProtocolsRequest extends Request
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
//        dd($request['firm']);
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



        if(isset($request['type_package']) && $request['type_package'] == 999 ) {
            $different = 'required|min:3|max:100|cyrillic';
        }
        else {
            $different  = '';
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

            'number_protocol'=>'required|numeric|not_in:0',
            'date_protocol' => 'required|date_format:d.m.Y',

            'crops' => 'required|not_in:0',
            'origin'=>'required|cyrillic_with|min:3|max:300',
            'tara'=>'required|my_numeric',
            'different' => $different,
            'variety'=>'cyrillic_with|min:3|max:1000',
            'documents'=>'cyrillic_with|min:3|max:1000',

            'actions'=>'cyrillic_with|min:3|max:1000',
            'name_trader'=>'required|cyrillic_with|min:3|max:500',

            'place'=>'required|cyrillic_with|min:3|max:100',
            'inspectors' => 'required|not_in:0',
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




            'number_protocol.required' => 'Номера на Протокола е здължителен!',
            'number_protocol.numeric' => 'За номер на Протокола използвай само цифри!',
            'number_protocol.not_in' => 'Номера на Протокола не може да нула - 0!',

            'date_protocol.required' => 'Датата на Протокола е здължителна!',
            'date_protocol.date_format' => 'Непозволен формат за Дата на Протокол!',

            'crops.required' => 'Избери култура!',
            'crops.not_in' => 'Избери култура!',

            'origin.required' => 'Попълни поле 2. Страна на произход!',
            'origin.cyrillic_with' => 'За Страна на произход използвай кирилица!',
            'origin.min' => 'За Страна на произход минимален брой символи - 3!',
            'origin.max' => 'За Страна на произход максимален брой символи - 300!',

            //'quality_class.required' => 'Избери 3. Означен клас на качество!',
            //'quality_class.not_in' => 'Избери 3. Означен клас на качество!',

            //'quality_naw.required' => 'Избери 4. Клас на качество в момента!',
            //'quality_naw.not_in' => 'Избери 4. Клас на качество в момента!',

            //'number.required' => 'Попълни поле 6. Брой!',
            //'number.my_numeric' => 'За поле 6. Брой - използвай само цифри!',

            'tara.required' => 'Попълни поле 5. Тегло бруто/нето(кг):!',
            'tara.my_numeric' => 'За поле 5. Тегло бруто/нето(кг): - използвай само цифри!',

            //'type_package.required' => 'Избери вида на опаковката!',
            //'type_package.not_in' => 'Избери вида на опаковката!',

            'different.required' => 'За Вида на опаковката е избрано - ДРУГО! Попълни Вида на опаковката',
            'different.cyrillic' => 'За Вида на опаковката използвай кирилица!',
            'different.min' => 'За Вида на опаковката минимален брой символи - 3!',
            'different.max' => 'За Вида на опаковката максимален брой символи - 100!',

            'variety.cyrillic_with' => 'За 7. Други идентификационни белези използвай кирилица без символите ( )!',
            'variety.min' => 'За 7. Други идентификационни белези - минимален брой символи - 3!',
            'variety.max' => 'За 7. Други идентификационни белези - максимален брой символи - 1000!',

            'documents.cyrillic_with' => 'За 8. Придружаващи стоката документи използвай кирилица без символите ( )!',
            'documents.min' => 'За 8. Придружаващи стоката документи - минимален брой символи - 3!',
            'documents.max' => 'За 8. Придружаващи стоката документи - максимален брой символи - 1000!',

            'actions.cyrillic_with' => 'За Действия на търговеца използвай кирилица без символите ( )!',
            'actions.min' => 'За Действия на търговеца - минимален брой символи - 3!',
            'actions.max' => 'За Действия на търговеца - максимален брой символи - 1000!',

            'name_trader.required' => 'Попълни Трите имена на търговеца или на негов представител!',
            'name_trader.cyrillic_with' => 'За Трите имена на търговеца или на негов представител използвай кирилица без символите ( )!',
            'name_trader.min' => 'За Трите имена на търговеца или на негов представитела - минимален брой символи - 3!',
            'name_trader.max' => 'За Трите имена на търговеца или на негов представител - максимален брой символи - 500!',

            'place.required' => 'Попълни Място на издаване!',
            'place.cyrillic_with' => 'За Място на издаване използвай кирилица без символите ( )!',
            'place.min' => 'За Място на издаване - минимален брой символи - 3!',
            'place.max' => 'За Място на издаване - максимален брой символи - 100!',

            'inspectors.required' => 'Избери инспектора извършил проверката!',
            'inspectors.not_in' => 'Избери инспектора извършил проверката!',
        ];
        return $data;
    }
}
