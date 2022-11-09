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
        return [
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
