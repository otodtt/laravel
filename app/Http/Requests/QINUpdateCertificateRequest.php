<?php

namespace odbh\Http\Requests;

use odbh\Http\Requests\Request;

class QINUpdateCertificateRequest extends Request
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
        if(isset($request['importer_data']) && $request['importer_data'] >= 0 ) {
            $importer_data = 'required|not_in:0';
            $packer_name_one = 'required|min:3|max:500';
            $packer_name_two = 'min:3|max:500';
            $packer_name_three = 'min:3|max:500';
        }
        else {
            $importer_data = '';
            $packer_name_one = '';
            $packer_name_two = '';
            $packer_name_three = '';
        }

        return [
            'importer_data' => $importer_data,

            'packer_name_one' => $packer_name_one,
            'packer_name_two' => $packer_name_two,
            'packer_name_three' => $packer_name_three,

            'from_country'=>'required|min:5|max:300',
            'id_country'=>'required',
            'observations'=>'min:2|max:500',
            'place_bg'=>'required|cyrillic_with|min:3|max:300',
            'valid_until'=>'required|date_format:d.m.Y|after:hidden_date',
        ];
    }

    /**
     * Проверка на входящите данни и мои съобщения
     * @return array
     */
    public function messages()
    {
        return [
            'importer_data.required' => 'Избери фирма търговец!',
            'importer_data.not_in' => 'Избери фирма търговец!',

            'trader_name.required' => 'Името е задължително!',
            'trader_name.cyrillic_with' => 'За Име на фирмата използвай само кирилица!',
            'trader_name.min' => 'Минимален брой символи за името - 3!',
            'trader_name.max' => 'Максимален брой символи за името - 100!',

            'trader_address.required' => 'Адреса на фирмата е задължителен',
            'trader_address.cyrillic_with' => 'За Адрес на фирмата използвай само кирилица!',
            'trader_address.min' => 'Минимален брой символи зa Адреса на фирмата - 3',
            'trader_address.max' => 'Максимален брой символи зa Адреса на фирмата - 3',

            'trader_vin.required' => 'ЕИК/Булстат на фирмата е задължителен',
            'trader_vin.is_valid' => 'ЕИК/Булстат не е верен! Провери отново!',
            'trader_vin.digits_between' => 'ЕИК/Булстат се изписва с цифри. Между 9 - 13 символа!',


            'packer_name_one.required' => 'Името на ОПАКОВЧИКА е задължително!',
            'packer_name_one.cyrillic_with' => 'За Име на ОПАКОВЧИКА използвай само кирилица!',
            'packer_name_one.min' => 'Минимален брой символи за името на ОПАКОВЧИКА - 3!',
            'packer_name_one.max' => 'Максимален брой символи за името на ОПАКОВЧИКА - 500!',

            'packer_name_two.cyrillic_with' => 'За Името на ОПАКОВЧИК 2 използвай само кирилица!',
            'packer_name_two.min' => 'Минимален брой символи зa Името на ОПАКОВЧИК Две - 3',
            'packer_name_two.max' => 'Максимален брой символи зa Името на ОПАКОВЧИК Две - 500',

            'packer_name_three.cyrillic_with' => 'За Името на ОПАКОВЧИК 3 използвай само кирилица!',
            'packer_name_three.min' => 'Минимален брой символи зa Името на ОПАКОВЧИК Три - 3',
            'packer_name_three.max' => 'Максимален брой символи зa Името на ОПАКОВЧИК Три - 500',

            'type_crops.required' => 'Избери дали е за консумация или преработка!',

            'from_country.required' => 'Поле № 4. Място на инспекцията/страна на произход е задължително!',
            'from_country.min' => 'Поле № 4. Място на инспекцията/страна на произход се изписва с минимум 5 символа!',
            'from_country.max' => 'Поле № 4. Място на инспекцията/страна на произход се изписва с максимум 300 символа!',

            'id_country.required' => 'Избери в Поле № 5. Регион или страна!',

            'observations.min' => 'Поле № 13. Забележки се изписва с минимум 2 символа!',
            'observations.max' => 'Поле № 13. Забележки се изписва с максимум 500 символа!',

            'place_bg.required' => 'Поле № 12. Място на издаване е задължително!',
            'place_bg.cyrillic_with' => 'Поле № 12. За Място на издаване използвай кирилица!',
            'place_bg.min' => 'Поле № 12. Място на издаване се изписва с минимум 5 символа!',
            'place_bg.max' => 'Поле № 12. Място на издаване се изписва с максимум 300 символа!',

            'valid_until.required' => 'Поле № 12. Валиден до .. е задължително! Избери дата!',
            'valid_until.date_format' => 'Поле № 12. Валиден до .. е в Непозволен формат за дата!',
            'valid_until.after' => 'Поле № 12. Валиден до .. трябва да е поне 1 ден след дата на Сертификата!',

        ];
    }
}
