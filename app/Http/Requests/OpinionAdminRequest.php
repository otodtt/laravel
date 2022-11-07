<?php

namespace odbh\Http\Requests;



class OpinionAdminRequest extends Request
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
        $number_protocol = null;
        $date_protocol = null;
        $request = Request::all();

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
        if(strlen($request['date_opinion']) == 0){
            $date_petition = 'required|date_format:d.m.Y';
        }
        else{
            $date_petition = 'required|date_format:d.m.Y|before:'.$request['date_opinion'];
        }
        $data = ([
            'number_opinion' => 'numeric|required',
            'date_opinion' => 'date_format:d.m.Y',

            'number_petition' => 'required|numeric|not_in:0',
            'date_petition' => $date_petition,

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
            'number_opinion.numeric' => 'Изходящия номер на Становището е само с цифри!',
            'number_opinion.required' => 'Изходящия номер на Становището e задължителен! Ако е необходимо сложи нула - 0',
            'date_opinion.date_format' => 'Непозволен формат за дата на Изходящ номер на Становище!',

            'number_petition.required' => 'Номера на Заявлението е задължителен!',
            'number_petition.numeric' => 'Номера на Заявлението е само с цифри!',
            'number_petition.not_in' => 'Номера на Заявлението трябва да е различно от нула - 0!',

            'date_petition.required' => 'Датата на Заявлението е задължителна!',
            'date_petition.date_format' => 'Непозволен формат за дата на Заявление!',
            'date_petition.before' => 'Датата на Изходящия номер не може да е преди датата на Заявлението!',

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

            'inspectors_protocol.required_if' => 'Маркирано е, че има Констативен Протокол - Избери Инспектора написал Протокола!',
            'inspectors_protocol.not_in' => 'Маркирано е, че има Констативен Протокол - Избери Инспектора написал Протокола!',

            'type_check.required' => 'Задължително маркирай вида на проверката!',

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
