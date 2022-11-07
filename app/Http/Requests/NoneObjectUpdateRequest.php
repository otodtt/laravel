<?php

namespace odbh\Http\Requests;


class NoneObjectUpdateRequest extends Request
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

        if(!isset($request['gender']) || strlen($request['gender']) == 1){
            $pin_validation = '';
        } else {
            $pin_validation = 'required|pin_validate_name|digits_between:9,10';
        }

        if(!isset($request['gender_owner']) || strlen($request['gender_owner']) == 1){
            $pin_owner = '';
            $owner = '';
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

        if(!isset($request['address']) || strlen($request['address']) < 3){
            $error = '';
        } else {
            $error = 'required|in:0';
        }
        $data = [
            'type_check' => 'required',
            'number' => 'required|numeric|not_in:0',
            'date_protocol' => 'required|date_format:d.m.Y',
            'inspector' => 'required',
            'inspector_two' => 'different:inspector',
            'inspector_three' => 'different:inspector|different:inspector_two',
            'inspector_another' => 'min:3|max:50|cyrillic|required_with:inspector_from',
            'inspector_from' => 'min:3|max:50|cyrillic_with|required_with:inspector_another',

            'firm'=> 'required',
            'name'=> 'min:3|max:50|cyrillic|required_if:firm,1',
            'gender'=> 'required_if:firm,1',
            'pin'=> $pin_validation,
            'pin_owner'=> $pin_owner,
            'owner'=> $owner,

            'name_firm'=> 'min:3|max:50|cyrillic_names|required_if:firm,2,3,4,5,6,7',
            'bulstat'=> 'required_if:bulls,1|is_valid',
            'bulls'=> 'required_if:firm,2,3,4,5,6,7',
            'gender_owner'=> 'required_if:firm,2,3,4,5,6,7',

            'localsID'=> 'not_in:0|required',
            'list_name'=> 'required',

            'localsObject'=> 'not_in:0|required',
            'list_name_ob'=> 'required',

            'address'=> 'min:3|max:50|cyrillic_with',
            'address_object'=> 'min:3|max:50|cyrillic_with|required',

            'violation' => $violation,
            'act' => $act,

            'ascertainment' => 'min:5|max:5000|required_if:violation,1',
            'taken' => 'min:5|max:5000',
            'order_protocol' => 'min:5|max:5000|required_if:violation,1',

            'assay_tor' => 'required',

            'error'=> $error,
            'error1'=>'in:0',
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
            'type_check.required' => 'Задължително маркирай вида на проверката!',

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

            'firm.required' => 'Маркирай вида на фирмата или Физическо Лице!',

            'name.required_if' => 'Попълни името на Лицето което се проверява!',
            'name.min' => 'Минимален брой символи за името - 3!',
            'name.max' => 'Минимален брой символи за името - 50!',
            'name.cyrillic' => 'За име използвай само на кирилица!!',

            'gender.required_if' => 'Маркирай дали е мъж, жена или Без ЕГН!',

            'pin.pin_validate_name' => 'ЕГН-то не отговаря! Виж дали правилно са попълнени данните!',
            'pin.digits_between' => 'ЕГН-то е само цифри с 10 знака!',
            'pin.required' => 'Попълни ЕГН!',

            'bulls.required_if' => 'Маркирай с "ДА" ако се знае ЕИК/Булстат! Ако не се знае, маркирай - "НЕ"',

            'name_firm.required_if' => 'Попълни името на Фирмата която се проверява!',
            'name_firm.min' => 'Минимален брой символи за името - 3!',
            'name_firm.max' => 'Минимален брой символи за името - 50!',
            'name_firm.cyrillic_names' => 'За име на фирмата пиши само на кирилица без символи! Позволени символи: (тире - ) и цифри!',

            'bulstat.required_if' => 'Маркирано е "ДА". Попълни ЕИК/Булстат! Ако не се знае, маркирай - "НЕ"',
            'bulstat.is_valid' => 'Невалиден БУЛСТАТ! Виж дали правилно е попълнен!',

            'gender_owner.required_if' => 'Маркирай Представиреля на Фирмата дали е мъж, жена или Без ЕГН!',
            'pin_owner.pin_validate_owner' => 'ЕГН-то на Представителя на Фирмата не отговаря! Виж дали правилно са попълнени данните!',
            'pin_owner.digits_between' => 'ЕГН-то е само цифри с 10 знака!',
            'pin_owner.required' => 'Попълни ЕГН!',

            'owner.required' => 'Попълни името на Представителя на Фирмата!',
            'owner.min' => 'Минимален брой символи за името - 3!',
            'owner.max' => 'Минимален брой символи за името - 50!',
            'owner.cyrillic' => 'За име Представител използвай само на кирилица!!',

            'localsID.not_in'=> 'Избери общината където е регистрирана Фирмата/Лицето!',
            'localsID.required'=> 'Избери общината където е регистрирана Фирмата/Лицето!',
            'list_name.required' => 'Избери населено място където е регистрирана Фирмата/Лицето',


            'localsObject.not_in'=> 'Избери общината където е проверявания обект!',
            'localsObject.required'=> 'Избери общината където е проверявания обект!',
            'list_name_ob.required' => 'Избери населено място от списъка за адрес на проверявания обект!',

            'address.min' => 'За адрес на Фирмата/Лицето - Минимален брой символи - 3!',
            'address.max' => 'За адрес на Фирмата/Лицето - Максимален брой символи за адрес - 50!',
            'address.cyrillic_with' => 'За адрес на Фирмата/Лицето - използвай само на кирилица!!',

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

            'assay_tor.required' => 'Задължително маркирай дали има взета проба от ТОР!',

            'error.required' => 'Попълнен е адрес на Фирмата/Лицето - Избери областта, общината и населено място от списъка!',
            'error.in' => 'Избраното населено място на Фирмата/Лицето не е от същата община или област! Провери областта и общината!',
            'error1.in' => 'За адрес на обекта - Избери населено място от списъка! Виж да не е избрана друга община!',

        ];
        return $data;
    }
}
