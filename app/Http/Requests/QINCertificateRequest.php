<?php

namespace odbh\Http\Requests;

use odbh\Http\Requests\Request;

class QINCertificateRequest extends Request
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
        if($request['type_crops'] == 44) {
            $packer_name = 'required|cyrillic_names|min:3|max:100';
            $packer_address = 'required|cyrillic_with|min:5|max:500';
            $packer_vin = 'required|is_valid|digits_between:9,10';
        } else {
            $packer_name = 'latin|min:3|max:500';
            $packer_address = 'latin|min:5|max:500';
            $packer_vin = 'is_valid|digits_between:9,10';
        }

        return [
            // 'what_7'=>'required',
            // 'type_crops'=>'required',
            // 'importer_data'=>'required',
            'importer_name' => 'required|cyrillic_names|min:3|max:100',
            'importer_address' => 'required|cyrillic_with|min:5|max:500',
            'importer_vin' => 'required|is_valid|digits_between:9,10',
            'packer_name'=>$packer_name,
            'packer_address'=>$packer_address,
            'packer_vin'=>$packer_vin,
            'from_country'=>'required|min:5|max:300',
            'id_country'=>'required',
            'observations'=>'min:2|max:500',
            // 'transport'=>'required|min:3|max:300',
            // 'customs_bg'=>'required|cyrillic_with|min:3|max:300',
            // 'customs_en'=>'required|latin|min:3|max:300',
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
            'type_crops.required' => 'Избери дали е за консумация или преработка!',
            // 'importer_data.required' => 'Избери Поле № 1 Избери фирмата! Търговеца!',

            'importer_name.required' => 'Поле № 1 Търговец е задължително!',
            'importer_name.cyrillic_names' => 'Поле № 1 За Име на Търговец използвай кирилица!',
            'importer_name.min' => 'Името на Търговец се изписва с минимум 3 символа!',
            'importer_name.max' => 'Името на Търговец се изписва с максимум 100 символа!',

            'importer_address.required' => 'Поле № 2 Адрес на Търговец е задължително!',
            'importer_address.cyrillic_with' => 'Поле № 2 За Адреса на Търговец използвай кирилица!',
            'importer_address.min' => 'Адреса на Търговец се изписва с минимум 5 символа!',
            'importer_address.max' => 'Адреса на Търговец се изписва с максимум 500 символа!',

            'importer_vin.required' => 'Поле № 1 ЕИК/Булстат на Търговец е задължително!',
            'importer_vin.is_valid' => 'Поле № 1 ЕИК/Булстат на Търговец не отговаря. Провери отново!',
            'importer_vin.digits_between' => 'Поле № 1 ЕИК/Булстат на Търговец се изписва между 9 и 10 символа!',

            'packer_data.required' => 'Избери Поле № 2 Избери фирмата! Опаковчик!',

            'packer_name.required' => 'Поле № 2 Опаковчик е задължително!',
            'packer_name.cyrillic_names' => 'Поле № 2 За Име на Опаковчик използвай кирилица!',
            'packer_name.min' => 'Името на Опаковчик се изписва с минимум 3 символа!',
            'packer_name.max' => 'Името на Опаковчик се изписва с максимум 100 символа!',

            'packer_address.required' => 'Поле № 2 Адреса на Опаковчик е задължително!',
            'packer_address.cyrillic_with' => 'Поле № 2 За Адреса на Опаковчик използвай кирилица!',
            'packer_address.min' => 'Адреса на Опаковчик се изписва с минимум 5 символа!',
            'packer_address.max' => 'Адреса на Опаковчик се изписва с максимум 500 символа!',

            'packer_vin.required' => 'Поле № 2 ЕИК/Булстат на Опаковчик е задължително!',
            'packer_vin.is_valid' => 'Поле № 2 ЕИК/Булстат на Опаковчик не отговаря. Провери отново!',
            'packer_vin.digits_between' => 'Поле № 2 ЕИК/Булстат на Опаковчик се изписва между 9 и 10 символа!',



            'from_country.required' => 'Поле № 4. Място на инспекцията/страна е задължително!',
            'from_country.min' => 'Поле № 4. Място на инспекцията се изписва с минимум 5 символа!',
            'from_country.max' => 'Поле № 4. Място на инспекцията се изписва с максимум 300 символа!',

            'id_country.required' => 'Избери в Поле № 5. Регион или страна!',

            'observations.min' => 'Поле № 13. Забележки се изписва с минимум 2 символа!',
            'observations.max' => 'Поле № 13. Забележки се изписва с максимум 500 символа!',

            'place_bg.required' => 'Поле № 12. Място на български е задължително!',
            'place_bg.cyrillic_with' => 'Поле № 12. За Място на български използвай кирилица!',
            'place_bg.min' => 'Поле № 12. Място на български се изписва с минимум 5 символа!',
            'place_bg.max' => 'Поле № 12. Място на български се изписва с максимум 300 символа!',

            'valid_until.required' => 'Поле № 12. Валиден до .. е задължително! Избери дата!',
            'valid_until.date_format' => 'Поле № 12. Валиден до .. е в Непозволен формат за дата!',
            'valid_until.after' => 'Поле № 12. Валиден до .. трябва да е поне 1 ден след дата на Сертификата!',

            // 'transport.required' => 'Поле № 6 Идентификация на транспортните средства е задължително!',
            // 'transport.min' => 'Поле № 6. Идентификация се изписва с минимум 3 символа!',
            // 'transport.max' => 'Поле № 6. Идентификация се изписва с максимум 300 символа!',
            // 'transport.latin' => 'Поле № 6 За Идентификация използвай латиница!',

            // 'customs_bg.required' => 'Поле № 12. Митница на български е задължително!',
            // 'customs_bg.cyrillic_with' => 'Поле № 12. За Митница на български използвай кирилица!',
            // 'customs_bg.min' => 'Поле № 12. Митница на български се изписва с минимум 5 символа!',
            // 'customs_bg.max' => 'Поле № 12. Митница на български се изписва с максимум 300 символа!',

            // 'customs_en.required' => 'Поле № 12. Митница на латиница е задължително!',
            // 'customs_en.latin' => 'Поле № 12. За Митница на латиница използвай латиница!',
            // 'customs_en.min' => 'Поле № 12. Митница на латиница се изписва с минимум 5 символа!',
            // 'customs_en.max' => 'Поле № 12. Митница на латиница се изписва с максимум 300 символа!',

            

            // 'place_en.required' => 'Поле № 12. Място на латиница е задължително!',
            // 'place_en.latin' => 'Поле № 12. За Място на латиница използвай латиница!',
            // 'place_en.min' => 'Поле № 12. Място на латиница се изписва с минимум 5 символа!',
            // 'place_en.max' => 'Поле № 12. Място на латиница се изписва с максимум 300 символа!',

            
        ];
    }
}
