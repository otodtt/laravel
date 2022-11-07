<?php

namespace odbh\Http\Requests;

//use odbh\Http\Requests\Request;

class CertificatesUpdateRequest extends Request
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
        $request = Request::all();

        if(!isset($request['gender']) || strlen($request['gender']) == 1){
            $pin_validation = '';
        } else {
            $pin_validation = 'required|pin_validate|digits_between:9,10';
        }
        if(strlen($request['date_diploma']) == 4){
            $diploma_validation = 'date_format:Y|after:1940|before:2020';
        } elseif(strlen($request['date_diploma']) == 10) {
            $diploma_validation = 'date_format:d.m.Y|after:01.01.1940|before:01.01.2020';
        } elseif(strlen($request['date_diploma']) == 0) {
            $diploma_validation = 'required';
        } else {
            $diploma_validation = 'date_format:d.m.Y|after:01.01.1940|before:01.01.2020';
        }

        $data = [
            'date' => 'required|date_format:d.m.Y|after:01.01.2014',

            'petition' => 'required|numeric|min:1',
            'date_petition' => 'required|date_format:d.m.Y|before:date',

            'invoice' => 'required|numeric|min:1',
            'date_invoice' => 'required|date_format:d.m.Y',

            'owner' => 'required|min:3|max:100|cyrillic',
            'gender' => 'required',
            'pin' => $pin_validation,

            'address' => 'required|min:3|max:150|cyrillic_with',
            'phone' => 'all_phone_validate',
            'email' => 'email',

            'document' => 'required|min:3|max:50|cyrillic',
            'series' => 'min:3|max:50|cyrillic_with',
            'number_diploma' => 'required|numeric',
            'date_diploma' => $diploma_validation,
            'from_institute' => 'required|min:3|max:250|cyrillic_with',
            'specialty' => 'required|min:3|max:150|cyrillic_with',

            'limit_certificate' => 'required',
            'inspector' => 'required',

            'file'=>'image|max:2000',
        ];
        return $data;
    }

    public function messages()
    {
        return [
            'date.required' => 'Датата на Сертификата е задължителна!',
            'date.date_format' => 'Непозволен формат за дата на Сертификат!',
            'date.after' => 'Датата на Сертификата не може да е преди 01.01.2014 г.! Преди 2014 г. не се издаваха Сертификати.',

            'petition.required' => 'Номера на Заявлението е задължителен!',
            'petition.numeric' => 'Номера на Заявлението е само с цифри!',
            'petition.min' => 'Номера на Заявлението не може да е нула - 0!',

            'date_petition.required' => 'Датата на Заявлението е задължителна!',
            'date_petition.date_format' => 'Непозволен формат за дата на Заявление!',
            'date_petition.before' => 'Датата на Заявлението трябва да е поне един ден преди датата на Сертификата!',

            'invoice.required' => 'Номера на Фактурата е задължителен!',
            'invoice.numeric' => 'Номера на Фактурата е само с цифри!',
            'invoice.min' => 'Номера на Фактурата не може да е нула - 0!',
            'date_invoice.required' => 'Датата на Фактурата е задължителна!',
            'date_invoice.date_format' => 'Непозволен формат за дата на Фактура!',

            'owner.required' => 'Попълни името на заявителя!',
            'owner.min' => 'Минимален брой символи за име - 3!',
            'owner.max' => 'Максимален брой символи за име - 100!',
            'owner.cyrillic' => 'Име - Пиши само на кирилица без символи!',

            'gender.required' => 'Маркирай  дали е мъж или жена! Ако не се знае ЕГН-то, маркитай - "Без ЕГН" ',

            'pin.required' => 'Попълни ЕГН!',
            'pin.pin_validate' => 'ЕГН-то не отговаря! Виж дали правилно са попълнени данните!',
            'pin.digits_between' => 'ЕГН-то е само цифри!',

            'address.required' => 'Адреса е задължителен!',
            'address.min' => 'Минимален брой символи за Адрес - 3!',
            'address.max' => 'Максимален брой символи за Адрес - 150!',
            'address.cyrillic_with' => 'Адрес - Пиши само на кирилица!',

            'phone.all_phone_validate' => 'Непозволен формат за изписване на телефон! Опитай по друг начин!',
            'email.email' => 'Невалиден електронен адрес!',

            'document.required' => 'Попълни вида на документа! Диплома, Удостоверение или друго.',
            'document.min' => 'Минимален брой символи за Документа - 3!',
            'document.max' => 'Максимален брой символи за Документа - 50!',
            'document.cyrillic' => 'Документ - Пиши само на кирилица!',

            'series.min' => 'Минимален брой символи за Серия на Документа - 3!',
            'series.max' => 'Максимален брой символи за Серия на Документа - 50!',
            'series.cyrillic_with' => 'Серия на Документа - Пиши само на кирилица!',

            'number_diploma.required' => 'Номера на Документа е задължителен!',
            'number_diploma.numeric' => 'За Номера на Документа се използват само цифри!',

            'date_diploma.required' => 'Датата на Документа е задължителна!',
            'date_diploma.date_format' => 'Непозволен формат за дата на Документа!',
            'date_diploma.after' => 'Непозволен формат за дата на Документа!',
            'date_diploma.before' => 'Непозволен формат за дата на Документа!',

            'from_institute.required' => 'Попълни Инститицията издала документа!',
            'from_institute.min' => 'Минимален брой символи за Инститицията издала документа - 3!',
            'from_institute.max' => 'Максимален брой символи за Инститицията издала документа - 250!',
            'from_institute.cyrillic_with' => 'Инститицията издала документа - Пиши само на кирилица!',

            'specialty.required' => 'Попълни Специалност или програма',
            'specialty.min' => 'Минимален брой символи за Специалност - 3!',
            'specialty.max' => 'Максимален брой символи за Специалност - 150!',
            'specialty.cyrillic_with' => 'Специалност - Пиши само на кирилица!',

            'limit_certificate.required' => 'Маркирай "БЕЗСРОЧЕН" или "С ОГРАНИЧЕН СРОК"',
            'inspector.required' => 'Маркирай инспектора обработил документите!',

            'file.image'=>'Непозволен формат на файла! Файла трябва да е "jpg" или "jpeg"!',
            'file.max'=>'Твърде голям формат на снимката! Файла трябва да е до 2 МВ!',
        ];
    }
}
