<?php

namespace odbh\Http\Requests;

use odbh\Http\Requests\Request;

class QProtocolsRequest extends Request
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
        if(isset($request['type_package']) && $request['type_package'] == 999 ) {
            $different = 'required|min:3|max:100|cyrillic';
        }
        else {
            $different  = '';
        }

        return [
            'number_protocol'=>'required|numeric|not_in:0',
            'date_protocol' => 'required|date_format:d.m.Y',

            'crops' => 'required|not_in:0',
            'origin'=>'required|cyrillic_with|min:3|max:300',
            'quality_class' => 'required|not_in:0',
            'quality_naw' => 'required|not_in:0',
            'number'=>'required|my_numeric',
            'type_package' => 'required|not_in:0',
            'different' => $different,
            'variety'=>'cyrillic_with|min:3|max:1000',
            'documents'=>'cyrillic_with|min:3|max:1000',

//            'id_country'=>'required',
//            'observations'=>'min:2|max:500',
//
//            'place_bg'=>'required|cyrillic_with|min:3|max:300',
//            'valid_until'=>'required|date_format:d.m.Y|after:hidden_date',
        ];
    }
    /**
     * Мои съобщения за грешки.
     *
     * @return array
     */
    public function messages() {
        $data = [
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

            'quality_class.required' => 'Избери 3. Означен клас на качество!',
            'quality_class.not_in' => 'Избери 3. Означен клас на качество!',

            'quality_naw.required' => 'Избери 4. Клас на качество в момента!',
            'quality_naw.not_in' => 'Избери 4. Клас на качество в момента!',

            'number.required' => 'Попълни поле 6. Брой!',
            'number.my_numeric' => 'За поле 6. Брой - използвай само цифри!',

            'type_package.required' => 'Избери вида на опаковката!',
            'type_package.not_in' => 'Избери вида на опаковката!',

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
        ];
        return $data;
    }
}
