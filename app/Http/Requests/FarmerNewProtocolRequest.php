<?php

namespace odbh\Http\Requests;

//use odbh\Http\Requests\Request;

class FarmerNewProtocolRequest extends Request
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

            'check_id'=>'required|not_in:0',
            'type_check' => 'required',
            'number_protocol' => 'required|numeric|min:1',
            'date_protocol' => 'required|date_format:d.m.Y',
            'inspector' => 'required',
            'inspector_two' => 'different:inspector',
            'inspector_three' => 'different:inspector|different:inspector_two',
            'inspector_another' => 'min:3|max:50|only_cyrillic|required_with:inspector_from',
            'inspector_from' => 'min:3|max:50|cyrillic_with|required_with:inspector_another',

            'violation' => $violation,
            'act' => $act,

            'ascertainment' => 'min:5|max:5000|required_if:violation,1',
            'taken' => 'min:5|max:5000',
            'order_protocol' => 'min:5|max:5000|required_if:violation,1',

            'assay_error'=>$assay_error,

            'assay_more_name' => 'min:2|max:100|required_if:assay_more,1|only_cyrillic',
            'assay_prz_name' => 'min:2|max:100|required_if:assay_prz,1|only_cyrillic',
            'assay_tor_name' => 'min:2|max:100|required_if:assay_tor,1|only_cyrillic',
            'assay_metal_name' => 'min:2|max:100|required_if:assay_metal,1|only_cyrillic',
            'assay_micro_name' => 'min:2|max:100|required_if:assay_micro,1|only_cyrillic',
            'assay_other_name' => 'min:2|max:100|required_if:assay_other,1|only_cyrillic',

        ];
        return $data;
    }

    /**
     * Мои съобщения за грешки.
     *
     * @return array
     */
    public function messages()
    {
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

            'district_object.required' => 'Задължително избери Общината където се намира стопанството!',
            'district_object.not_in' => 'Задължително избери Общината където се намира стопанството!',

            'location_farm.min' => 'Минимален брой символи за Населено място\места - 3!',
            'location_farm.max' => 'Минимален брой символи за Населено място\места - 50!',
            'location_farm.cyrillic_names_objects' => 'За Населено място\места пиши на кирилица без символи! Позволени символи (точка, запетая, точка и запетая) - . , ;',

            'error.in' => 'Избери населено място от списъка! Виж да не е избрана друга община!',

            'address.required' => 'Адреса е задължителен!',
            'address.min' => 'За Адреса минимален брой символи - 3!',
            'address.max' => 'За Адреса максимале брой символи - 500!',
            'address.cyrillic_with' => 'За Адреса пиши на кирилица!',

            'phone.phone_validate' => 'Непозволен формат на телефонния номер!',
            'mobil.mobile_validate' => 'Непозволен формат на мобилния номер!',
            'email.email' => 'Непозволен формат на електронен адрес!',


            'check_id.required'=>'Задължително избери вида на проверката!',
            'check_id.not_in'=>'Задължително избери вида на проверката!',

            'type_check.required' => 'Маркирай дали проверката е документална или на терен!',

            'number_protocol.required' => 'Номера на Протокола е здължителен!',
            'number_protocol.numeric' => 'За номер на Протокола използвай само цифри!',
            'number_protocol.min' => 'Номера на Протокола не може да нула - 0!',

            'date_protocol.required' => 'Датата на Протокола е здължителна!',
            'date_protocol.date_format' => 'Непозволен формат за Дата на Протокол!',

            'inspector.required' => 'Задължително избери водещ инспектор!',
            'inspector_two.different' => 'Не може да бъде избиран един и същ инспектор!',
            'inspector_three.different' => 'Не може да бъде избиран един и същ инспектор!',

            'inspector_another.min' => 'Минимален брой символи за име на инспектор - 3!',
            'inspector_another.max' => 'Максимален брой символи за име на инспектор - 50!',
            'inspector_another.only_cyrillic' => 'За името на инспектора използвай само на кирилица!',
            'inspector_another.required_with' => 'Попълни полето името на инспектора!',

            'inspector_from.min' => 'Минимален брой символи за полето "От служба:" - 3!',
            'inspector_from.max' => 'Максимален брой символи за полето "От служба:" - 50!',
            'inspector_from.cyrillic_with' => 'За полето "От служба:" използвай само на кирилица!',
            'inspector_from.required_with' => 'Попълни полето "От служба:"!',

            'violation.in' => 'Не може да има АКТ без нарушение! Маркирай с ДА в полето "Констатирани нарушения: "',
            'violation.required' => 'Задължително маркирай дали има Констатирани нарушения!',

            'act.required_if' => 'Маркирано е, че има нарушрние. Маркирай дали има съставен АКТ!',
            'act.required' => 'Маркирай дали има съставен АКТ!',

            'ascertainment.min' => 'Минимален брой символи за полето "Констатация:" - 5!',
            'ascertainment.max' => 'Максимален брой символи за полето "Констатация:" - 5000!',
            'ascertainment.required_if' => 'Маркирано е, че има нарушрние. Опиши нарушението в полето "Констатация:" !',

            'taken.min' => 'Минимален брой символи за полето "Конфискувани:" - 5!',
            'taken.max' => 'Максимален брой символи за полето "Конфискувани:" - 5000!',

            'order_protocol.min' => 'Минимален брой символи за полето "Предписание:" - 5!',
            'order_protocol.max' => 'Максимален брой символи за полето "Предписание:" - 5000!',
            'order_protocol.required_if' => 'Маркирано е, че има нарушрние. Опиши направените предписания!',

            'assay_error.not_in' => 'Задължително маркирай дали има взета проба или вида на пробата!',

            'assay_more_name.min' => 'Минимален брой символи за полето "Проба от:" - 2!',
            'assay_more_name.max' => 'Максимален брой символи за полето "Проба от:" - 100!',
            'assay_more_name.only_cyrillic' => 'За полето "Проба от:" - Пиши само на кирилица',
            'assay_more_name.required_if' => 'Маркирано е, че има взета проба за остатъци от ПРЗ. Напиши културата!',

            'assay_prz_name.min' => 'Минимален брой символи за полето "Проба от:" - 2!',
            'assay_prz_name.max' => 'Максимален брой символи за полето "Проба от:" - 100!',
            'assay_prz_name.only_cyrillic' => 'За полето "Проба от:" - Пиши само на кирилица',
            'assay_prz_name.required_if' => 'Маркирано е, че има взета проба за индентификация на ПРЗ. Напиши културата!',

            'assay_tor_name.min' => 'Минимален брой символи за полето "Проба от:" - 2!',
            'assay_tor_name.max' => 'Максимален брой символи за полето "Проба от:" - 100!',
            'assay_tor_name.only_cyrillic' => 'За полето "Проба от:" - Пиши само на кирилица',
            'assay_tor_name.required_if' => 'Маркирано е, че има взета проба за нитрати. Напиши културата!',

            'assay_metal_name.min' => 'Минимален брой символи за полето "Проба от:" - 2!',
            'assay_metal_name.max' => 'Максимален брой символи за полето "Проба от:" - 100!',
            'assay_metal_name.only_cyrillic' => 'За полето "Проба от:" - Пиши само на кирилица',
            'assay_metal_name.required_if' => 'Маркирано е, че има взета проба за Тежки метали. Напиши културата!',

            'assay_micro_name.min' => 'Минимален брой символи за полето "Проба от:" - 2!',
            'assay_micro_name.max' => 'Максимален брой символи за полето "Проба от:" - 100!',
            'assay_micro_name.only_cyrillic' => 'За полето "Проба от:" - Пиши само на кирилица',
            'assay_micro_name.required_if' => 'Маркирано е, че има взета проба за Микробиологични замърсители. Напиши културата!',

            'assay_other_name.min' => 'Минимален брой символи за полето "Проба от:" - 2!',
            'assay_other_name.max' => 'Максимален брой символи за полето "Проба от:" - 100!',
            'assay_other_name.only_cyrillic' => 'За полето "Проба от:" - Пиши само на кирилица',
            'assay_other_name.required_if' => 'Маркирано е, че има взета проба. Напиши културата!',
        ];
        return $data;
    }
}
