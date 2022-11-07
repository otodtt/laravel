<?php

namespace odbh\Http\Requests;

use odbh\Set;

class OtherObjectRequest extends Request
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
        $violation = null;
        $act = null;
        $request = Request::all();

        $permit = Set::select('area_id')->where('id','=',1)->get()->toArray();
        if(!isset($request['gender_owner']) || strlen($request['gender_owner']) == 2){
            $pin_owner = '';
            $owner = 'min:3|max:50|cyrillic';
        } else {
            $pin_owner = 'required|pin_validate_owner|digits_between:9,10';
            $owner = 'min:3|max:50|cyrillic|required';
        }

        if(!isset($request['act']) || $request['act'] == 0){
            $violation = 'required';
            $act = 'required_if:violation,1|required';
        }
        if(isset($request['act']) && $request['act'] == 1){
            $violation = 'in:1|required';
            $act = 'required';
        }
        $data = [
            'ot' => 'required',
            'number' => 'required|numeric|not_in:0',
            'date_protocol' => 'required|date_format:d.m.Y',

            'inspector' => 'required',
            'inspector_two' => 'different:inspector',
            'inspector_three' => 'different:inspector|different:inspector_two',
            'inspector_another' => 'min:3|max:50|cyrillic|required_with:inspector_from',
            'inspector_from' => 'min:3|max:50|cyrillic_with|required_with:inspector_another',

            'firm'=> 'required',
            'name'=> 'min:3|max:50|cyrillic_names|required',
            'bulstat'=> 'required_if:bulls,1|is_valid',
            'bulls'=> 'required',

            'owner'=> $owner,
            'gender_owner'=> 'required',
            'pin_owner'=> $pin_owner,

            'localsID'=> 'not_in:0|required',
            'list_name'=> 'required',

            'areasIDObject'=> 'required|not_in:'.$permit[0]['area_id'],
            'localsIDObject'=> 'required|not_in:0',
            'list_name_object'=> 'required',

            'address'=> 'min:3|max:50|cyrillic_with|required',
            'address_object'=> 'min:3|max:50|cyrillic_with|required',

            'violation' => $violation,
            'act' => $act,

            'ascertainment' => 'min:5|max:5000|required_if:violation,1',
            'taken' => 'min:5|max:5000',
            'order_protocol' => 'min:5|max:5000|required_if:violation,1',

            'error'=>'in:0',
            'error2'=>'in:0',
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
            'ot.required' => 'Задължително избери вида на обекта!',

            'number.required' => 'Номера на Протокола е здължителен!',
            'number.numeric' => 'За номер на Протокола използвай само цифри!',
            'number.not_in' => 'Номера на Протокола не може да нула - 0!',

            'date_protocol.required' => 'Датата на Протокола е здължителна!',
            'date_protocol.date_format' => 'Непозволен формат за Дата на Протокол!',

            'inspector.required' => 'Задължително избери водещ инспектор!',
            'inspector_two.different' => 'Не може да бъде избиран един и същ инспектор!',
            'inspector_three.different' => 'Не може да бъде избиран един и същ инспектор!',

            'inspector_another.min' => 'Минимален брой символи за име на инспектор - 3!',
            'inspector_another.max' => 'Максимален брой символи за име на инспектор - 50!',
            'inspector_another.cyrillic' => 'За името на инспектора използвай само на кирилица!',
            'inspector_another.required_with' => 'Попълни полето името на инспектора!',

            'inspector_from.min' => 'Минимален брой символи за полето "От служба:" - 3!',
            'inspector_from.max' => 'Максимален брой символи за полето "От служба:" - 50!',
            'inspector_from.cyrillic_with' => 'За полето "От служба:" използвай само на кирилица!',
            'inspector_from.required_with' => 'Попълни полето "От служба:"!',

            'firm.required' => 'Маркирай вида на фирмата!',

            'name.required' => 'Попълни името на Фирмата собственик на обекта!',
            'name.min' => 'Минимален брой символи за името - 3!',
            'name.max' => 'Минимален брой символи за името - 50!',
            'name.cyrillic_names' => 'За име Фирма използвай само кирилица, без символи! Позволени символи тире, точка и цифри (- .)!',

            'bulls.required' => 'Маркирай с "ДА" ако се знае ЕИК/Булстат! Ако не се знае, маркирай - "НЕ"',
            'bulstat.required_if' => 'Маркирано е "ДА". Попълни ЕИК/Булстат! Ако не се знае, маркирай - "НЕ"',
            'bulstat.is_valid' => 'Невалиден БУЛСТАТ! Виж дали правилно е попълнен!',

            'gender_owner.required' => 'Маркирай Представиреля на Фирмата дали е мъж, жена или Без ЕГН!',
            'pin_owner.pin_validate_owner' => 'ЕГН-то на Представителя на Фирмата не отговаря! Виж дали правилно са попълнени данните!',
            'pin_owner.digits_between' => 'ЕГН-то е само цифри с 10 знака!',
            'pin_owner.required' => 'Попълни ЕГН!',

            'owner.required' => 'Попълни името на Представителя на Фирмата!',
            'owner.min' => 'Минимален брой символи за името на управителя/представителя на фирмата - 3!',
            'owner.max' => 'Минимален брой символи за името - 50!',
            'owner.cyrillic' => 'За име Представител използвай само на кирилица!!',

            'localsID.not_in'=> 'Избери общината където е регистрирана Фирмата!',
            'localsID.required'=> 'Избери общината където е регистрирана Фирмата!',
            'list_name.required' => 'Избери населено място където е регистрирана Фирмата',

            'areasIDObject.not_in'=> 'Избраната област за проверявания обект Задължително трябва да е ралична от Вашето ОДБХ!',
            'localsIDObject.required'=> 'Избери общината където е проверявания обект!',
            'localsIDObject.not_in'=> 'Избери общината където е проверявания обект!',
            'list_name_object.required' => 'Избери населено място от списъка за адрес на проверявания обект!',

            'address.min' => 'За адрес на Фирмата - Минимален брой символи - 3!',
            'address.max' => 'За адрес на Фирмата- Максимален брой символи за адрес - 50!',
            'address.cyrillic_with' => 'За адрес на Фирмата - използвай само на кирилица!!',
            'address.required' => 'Адреса на Фирмата е задължителен!!',

            'address_object.required' => 'Адреса на проверявания обект е задължителен!',
            'address_object.min' => 'За адрес на на проверявания обект - Минимален брой символи - 3!',
            'address_object.max' => 'За адрес на на проверявания обект - Максимален брой символи за адрес - 50!',
            'address_object.cyrillic_with' => 'За адрес на на проверявания обект - използвай само на кирилица!!',

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

            'error.in' => 'Данни на Фирмата - Избраните област, община и населено място не отговарят! Избери първо област и община и след това населено място от спсъка!',
            'error2.in' => 'Адрес на проверения обек - Избраните област, община и населено място не отговарят! Избери първо област и община и след това населено място от спсъка!',
        ];
        return $data;
    }
}
