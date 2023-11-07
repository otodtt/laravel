<?php

namespace odbh\Http\Requests;

use odbh\Http\Requests\Request;

class PhitoOperatorsRequests extends Request
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
//        dd( strlen($request['others']));
        if( !isset($request['production']) && !isset($request['processing']) && !isset($request['import']) &&
            !isset($request['export']) && !isset($request['trade']) && !isset($request['storage']) &&
            !isset($request['treatment']) && strlen($request['others']) == 0) {
            $activity = 'required';
        }
        else {
            $activity = '';
        }

        if( !isset($request['europa']) &&  !isset($request['bulgaria'])  &&  !isset($request['own'])  && strlen($request['origin_from']) == 0) {
            $origin = 'required';
        }
        else {
            $origin = '';
        }
        return [
            'number_petition'=> 'required|numeric|not_in:0',
            'date_petition'=> 'required|date_format:d.m.Y',

            'description_objects'=> 'required|min:3|max:500|cyrillic_with',
            'description_places'=> 'required|min:3|max:500|cyrillic_with',
            'activity' => $activity,
            'others'=> 'min:3|max:50|cyrillic_with',
            'plants'=> 'required|min:3|max:500|cyrillic_with',
            'origin' => $origin,
            'origin_from'=> 'min:3|max:100|cyrillic_with',

            'passports'=> 'required',
            'marking'=> 'required',
        ];
    }

    /**
     * Мои съобщения за грешки.
     * @return array
     */
    public function messages()
    {
        return [
            'number_petition.required' => 'Номера на Заявлението е здължителен!',
            'number_petition.numeric' => 'За номер на Заявлението използвай само цифри!',
            'number_petition.not_in' => 'Номера на Заявлението не може да нула - 0!',

            'date_petition.required' => 'Дата на Заявлението е здължителна!',
            'date_petition.date_format' => 'Непозволен формат за Дата на Заявление!',

            'description_objects.required' => 'Попълни II. Данни за местата на провеждане на дейността!',
            'description_objects.min' => 'Минимален брой символи за II. Данни за местата на провеждане на дейността - 3!',
            'description_objects.max' => 'Максимален брой символи за II. Данни за местата на провеждане на дейността - 500!',
            'description_objects.cyrillic_with' => 'За II. Данни за местата на провеждане на дейността - пиши на кирилица!!',

            'description_places.required' => 'Попълни IIА. Данни за местата на провеждане....!',
            'description_places.min' => 'Минимален брой символи за IIА. Данни за местата на провеждане.... - 3!',
            'description_places.max' => 'Максимален брой символи за IIА. Данни за местата на провеждане.... - 500!',
            'description_places.cyrillic_with' => 'За IIА. Данни за местата на провеждане.... пиши на кирилица!!',

            'activity.required' => 'III. Вид на дейността! Маркирай поне една дейност!',
            'origin.required' => 'V. Произход на растенията! Маркирай или попълни произхода на растенията!',

//            'others.required' => 'Попълни  8. други (изброяват се)!',
            'others.min' => 'Минимален брой символи за 8. други (изброяват се) - 3!',
            'others.max' => 'Максимален брой символи за 8. други (изброяват се) - 50!',
            'others.cyrillic_with' => 'За 8. други (изброяват се) - пиши на кирилица!!',

            'plants.required' => 'Попълни  IV. Наименование на растенията!',
            'plants.min' => 'Минимален брой символи за IV. Наименование на растенията - 3!',
            'plants.max' => 'Максимален брой символи за IV. Наименование на растенията - 500!',
            'plants.cyrillic_with' => 'За IV. Наименование на растенията - пиши на кирилица!!',

            'origin_from.min' => 'Минимален брой символи за "внос от трета/и държава/и" - 3!',
            'origin_from.max' => 'Максимален брой символи за "внос от трета/и държава/и" - 100!',
            'origin_from.cyrillic_with' => 'За "внос от трета/и държава/и" - пиши на кирилица!!',

            'passports.required' => 'VI. Маркирай има ли Заявление за издаване на паспорт!',
            'marking.required' => 'VII.. Маркирай има ли Заявление за маркировка върху дървен опаковъчен материал!',




            'number_licence.required' => 'Номера на Удостоверението е здължителен!',
            'number_licence.numeric' => 'За Номер на Удостоверение използвай само цифри!',
            'number_licence.not_in' => 'Номера на Удостоверение не може да нула - 0!',

            'date_licence.required' => 'Датата на Удостоверението е здължителна!',
            'date_licence.date_format' => 'Непозволен формат за Дата на Удостоверение!',
            'date_licence.after' => 'Датата на Удостоверение не може да е преди 01.01.2014 г. Преди това не се издавха Удостоверения.',

            'localsID.required' => 'Избери общината където е регистрирана Аптеката!',
            'list_name.required' => 'Избери населено място от списъка!',



            'seller.required' => 'Попълни името на продавач-консултанта!',
            'seller.min' => 'Минимален брой символи за име на продавач-консултанта - 3!',
            'seller.max' => 'Минимален брой символи за име на продавач-консултанта - 50!',
            'seller.cyrillic' => 'За името на продавач-консултанта използвай само на кирилица!',

            'index_certificate.required' => 'Избери индекса на Сертификата! Службата от която е издаден.',

            'certificate.required' => 'Попълни номера на Сертификата',
            'certificate.numeric' => 'За Номер на Сертификата използвай само цифри!',
            'certificate.not_in' => 'Номер на Сертификата не може да нула 0!',

            'date_certificate.required' => 'Дата на Сертификата е здължителна!',
            'date_certificate.date_format' => 'Непозволен формат за Дата на Сертификат!',

            'inspector.required' => 'Избери инспектора обработил документите!',

            'error.in' => 'Избери първо общината и после населеното място! Виж да не е избрана друга община!',
        ];
    }
}
