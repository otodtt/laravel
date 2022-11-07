<?php

namespace odbh\Http\Requests;


class OpinionExistRequest extends Request
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
        $assay_error = null;
        $request = Request::all();

        if(isset($request['has_protocol']) && $request['has_protocol'] == 1){
            $inspectors = 'required_if:has_protocol,1|not_in:0';
            $number_protocol = 'required_if:has_protocol,1|numeric|not_in:0';
            $date_protocol = 'required_if:has_protocol,1|date_format:d.m.Y';

            if(!isset($request['assay_no']) || !isset($request['assay_more']) || !isset($request['assay_prz'])  || !isset($request['assay_tor'])
                || !isset($request['assay_metal']) || !isset($request['assay_micro']) || !isset($request['assay_other'])){
                $assay_error = 'not_in:0';
            }
            else{
                $assay_error = '';
            }
        }
        else{
            $inspectors = 'required_if:has_protocol,1';
            $number_protocol = 'required_if:has_protocol,1|numeric';
            $date_protocol = 'required_if:has_protocol,1';
            $assay_error = '';
        }
        ///
        if(isset($request['type_firm']) && $request['type_firm'] == 1){
            $owner = '';
            $gender_owner = '';
            $pin_owner = '';
        }
        elseif(isset($request['type_firm']) && $request['type_firm'] > 1){
            $owner = 'min:3|max:100|cyrillic';
            $gender_owner = 'required';

            if(!isset($request['gender_owner']) || strlen($request['gender_owner']) == 1){
                $pin_owner = '';
            } else {
                $pin_owner = 'required|pin_validate_owner|digits_between:9,10';
            }
        }
        else{
            $owner = '';
            $gender_owner = '';
            $pin_owner = '';
        }
        $data = ([
            'number_petition' => 'required|numeric|not_in:0',
            'date_petition' => 'required|date_format:d.m.Y',
            'invoice' => 'required|numeric|not_in:0',
            'invoice_date' => 'required|date_format:d.m.Y',
            'opinion' => 'required|not_in:0',
            'yes' => 'required',

            'owner'=> $owner,
            'gender_owner'=> $gender_owner,
            'pin_owner'=> $pin_owner,

            'list_name'=> 'required',
            'address'=> 'required|min:3|max:50|cyrillic_with',

            'phone'=> 'phone_validate',
            'mobil'=> 'mobile_validate',
            'email'=> 'email',

            'district_object' => 'required|not_in:0',
            'object_name' => 'min:3|max:50|cyrillic_names_objects',

            'inspectors' => 'required|not_in:0',
            'has_protocol' => 'required',

            'number_protocol' => $number_protocol,
            'date_protocol' => $date_protocol,
            'inspectors_protocol' => $inspectors,

            'assay_error'=>$assay_error,
            'type_check' => 'required',

            'error'=>'in:0'
        ]);
        return $data;
    }

    /**
     * Мои съобщения за грешки.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'number_petition.required' => 'Номера на Заявлението е задължителен!',
            'number_petition.numeric' => 'Номера на Заявлението е само с цифри!',
            'number_petition.not_in' => 'Номера на Заявлението трябва да е различно от нула - 0!',

            'date_petition.required' => 'Датата на Заявлението е задължителна!',
            'date_petition.date_format' => 'Непозволен формат за дата на Заявление!',

            'invoice.required' => 'Номера на Фактурата е задължителен!',
            'invoice.numeric' => 'Номера на Фактурата е само с цифри!',
            'invoice.not_in' => 'Номера на Фактурата трябва да е различно от нула - 0!',
            'invoice_date.required' => 'Датата на Фактурата е задължителна!',
            'invoice_date.date_format' => 'Непозволен формат за дата на Фактура!',

            'opinion.required' => 'Избери мярката за която ще се издава Становището!',
            'opinion.not_in' => 'Избери мярката за която ще се издава Становището!',

            'yes.required' => 'Маркирай дали Земеделското стопанство отговаря на изискванията на ЗЗР!',

            'list_name.required' => 'Избери населено място от списъка!',
            'address.required' => 'Адреса е задължителен!',
            'address.min' => 'Минимален брой символи за адрес - 3!',
            'address.max' => 'Максимален брой символи за адрес - 50!',
            'address.cyrillic_with' => 'За адрес - Пиши само на кирилица!!',

            'phone.phone_validate' => 'Некоректен формат на изписване на телефон.',
            'mobil.mobile_validate' => 'Некоректен формат на изписване на мобилен телефон.',
            'email.email' => 'Некоректен формат на електроната поща! Махни празните полета',

            'district_object.required' => 'Задължително избери Общината където се намира стопанството на Заявителя!',
            'district_object.not_in' => 'Задължително избери Общината където се намира стопанството на Заявителя!',

            'object_name.min' => 'Минимален брой символи за Населено място\места - 3!',
            'object_name.max' => 'Минимален брой символи за Населено място\места - 50!',
            'object_name.cyrillic_names_objects' => 'За Населено място\места пиши на кирилица без символи! Позволени символи (точка, запетая, точка и запетая) - . , ;',

            'inspectors.required' => 'Задължително избери Инспектора обработил документите за Становището!',
            'inspectors.not_in' => 'Задължително избери Инспектора обработил документите за Становището!',

            'has_protocol.required' => 'Задължително маркирай дали към Становището има издаден Констативен Протокол!',

            'number_protocol.required_if' => 'Маркирано е, че има Констативен Протокол - Поълни номера на Протокола!',
            'number_protocol.numeric' => 'Номера на Констативния Протокол е само с цифри!',
            'number_protocol.not_in' => 'Номера на Протокола трябва да е различно от нула - 0!',

            'date_protocol.required_if' => 'Маркирано е, че има Констативен Протокол - Поълни датата на Протокола!',
            'date_protocol.date_format' => 'Непозволен формат за дата на Констативн Протокол!',

            'inspectors_protocol.required_if' => 'Маркирано е, че има Констативен Протокол - Избери Инспектора написал Протокола!',
            'inspectors_protocol.not_in' => 'Маркирано е, че има Констативен Протокол - Избери Инспектора написал Протокола!',

            'type_check.required' => 'Задължително маркирай вида на проверката!',
            'assay_error.not_in' => 'Задължително маркирай дали има взета проба или вида на пробата!',

            'owner.min' => 'Минимален брой символи за име на Управител - 3!',
            'owner.max' => 'Максимален брой символи за име на Управител - 100!',
            'owner.cyrillic' => 'За име на Управител - Пиши само на кирилица без символи!',

            'gender_owner.required' => 'Маркирай  дали е мъж или жена! Ако не се знае ЕГН-то, маркирай - "Без ЕГН" ',

            'pin_owner.required' => 'Попълни ЕГН на Управителя или маркирай - "Без ЕГН"!',
            'pin_owner.pin_validate_owner' => 'ЕГН-то на Управителя не отговаря! Виж дали правилно са попълнени данните!',
            'pin_owner.digits_between' => 'ЕГН-то е само цифри!',

            'error.in' => 'Избери населено място от списъка! Виж да не е избрана друга община!',
        ];
    }
}
