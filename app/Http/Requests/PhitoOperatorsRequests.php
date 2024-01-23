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

        if( !isset($request['production']) && !isset($request['processing']) && !isset($request['import']) &&
            !isset($request['export']) && !isset($request['trade']) && !isset($request['storage']) &&
            !isset($request['treatment']) && strlen($request['others']) == 0) {
            $type = 'required';
        }
        else {
            $type = '';
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

            'description_objects_one'=> 'required|min:3|max:500|cyrillic_with',
            'description_places_one'=> 'required|min:3|max:500|cyrillic_with',
            'description_objects_two'=> 'min:3|max:5000|cyrillic_with',
            'description_places_two'=> 'min:3|max:5000|cyrillic_with',

            'type' => $type,
            'others'=> 'min:3|max:50|cyrillic_with',
            'plants'=> 'required|min:3|max:500|cyrillic_with',
            'origin' => $origin,
            'origin_from'=> 'min:3|max:100|cyrillic_with',

            'passports'=> 'required',
            'passports_list'=> 'min:3|max:5000|cyrillic_with',
            'marking'=> 'required',
            'marking_list'=> 'min:3|max:5000|cyrillic_with',

            'contact'=> 'required|min:3|max:500|cyrillic_with',
            'contact_phone'=> 'numeric',
            'contact_address'=> 'required|min:3|max:500|cyrillic_with',
            'contact_city'=> 'required|min:3|max:100|cyrillic_with',

            'place'=> 'required|min:3|max:500|cyrillic_with',
            'date_place'=> 'required|date_format:d.m.Y',

            'registration'=> 'required',
            'registration_note'=> 'min:3|max:500|cyrillic_with',
            'disposition'=> 'required',
            'disposition_note'=> 'min:3|max:500|cyrillic_with',
            'property'=> 'required',
            'property_note'=> 'min:3|max:500|cyrillic_with',
            'plants_origin'=> 'required',
            'plants_note'=> 'min:3|max:500|cyrillic_with',
            'others_note'=> 'min:3|max:500|cyrillic_with',

            'accepted'=> 'not_in:0',
            'free_text'=> 'min:3|max:5000|cyrillic_with',
            'checked'=> 'not_in:0',
            'date_operator'=> 'required|date_format:d.m.Y',

            'activity'=> 'required|min:3|max:50|cyrillic_with',
            'products'=> 'required|min:3|max:50|cyrillic_with',
            'derivation'=> 'required|min:3|max:50|cyrillic_with',
            'purpose'=> 'required|min:3|max:50|cyrillic_with',
            'room'=> 'min:3|max:50|cyrillic_with',
            'action'=> 'min:3|max:50|cyrillic_with',
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

            'description_objects_one.required' => 'Попълни II. 1 Данни за местата на провеждане на дейността!',
            'description_objects_one.min' => 'Минимален брой символи за II. 1 Данни за местата на провеждане на дейността - 3!',
            'description_objects_one.max' => 'Максимален брой символи за II. 1 Данни за местата на провеждане на дейността - 500!',
            'description_objects_one.cyrillic_with' => 'За II. 1 Данни за местата на провеждане на дейността - пиши на кирилица!!',

            'description_objects_two.min' => 'Минимален брой символи за II. 2 Данни за местата на провеждане на дейността - 3!',
            'description_objects_two.max' => 'Максимален брой символи за II. 2 Данни за местата на провеждане на дейността - 500!',
            'description_objects_two.cyrillic_with' => 'За II. 2 Данни за местата на провеждане на дейността - пиши на кирилица!!',

            'description_places_one.required' => 'Попълни IIА. 1 Данни за местата на провеждане....!',
            'description_places_one.min' => 'Минимален брой символи за IIА. 1 Данни за местата на провеждане.... - 3!',
            'description_places_one.max' => 'Максимален брой символи за IIА. 1 Данни за местата на провеждане.... - 500!',
            'description_places_one.cyrillic_with' => 'За IIА. 1 Данни за местата на провеждане.... пиши на кирилица!!',

            'description_places_two.min' => 'Минимален брой символи за IIА. 2 Данни за местата на провеждане.... - 3!',
            'description_places_two.max' => 'Максимален брой символи за IIА. 2 Данни за местата на провеждане.... - 500!',
            'description_places_two.cyrillic_with' => 'За IIА. 2 Данни за местата на провеждане.... пиши на кирилица!!',

            'type.required' => 'III. Вид на дейността! Маркирай поне една дейност!',
            'origin.required' => 'V. Произход на растенията! Маркирай или попълни произхода на растенията!',

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
            'marking.required' => 'VII. Маркирай има ли Заявление за маркировка върху дървен опаковъчен материал!',

            'passports_list.min' => 'Минимален брой символи за VI. За подробен опис на растенията.... - 3!',
            'passports_list.max' => 'Максимален брой символи за VI. За подробен опис на растенията.... - 5000!',
            'passports_list.cyrillic_with' => 'За VI. За подробен опис на растенията.... пиши на кирилица!!',

            'marking_list.min' => 'Минимален брой символи за VII. За технически спецификации.... - 3!',
            'marking_list.max' => 'Максимален брой символи за VII. За технически спецификации.... - 5000!',
            'marking_list.cyrillic_with' => 'За VII. За технически спецификации.... пиши на кирилица!!',

            'contact.required' => 'Попълни VIII. ЛИЦАТА ЗА КОНТАКТ!',
            'contact.min' => 'Минимален брой символи за VIII. ЛИЦАТА ЗА КОНТАКТ - 3!',
            'contact.max' => 'Максимален брой символи за VIII. ЛИЦАТА ЗА КОНТАКТ - 500!',
            'contact.cyrillic_with' => 'За VIII. ЛИЦАТА ЗА КОНТАКТ пиши на кирилица!!',

            'contact_phone.numeric' => 'За номер на ЛИЦАТА ЗА КОНТАКТ използвай само цифри!',

            'contact_address.required' => 'Попълни VIII. АДРЕСА НА ЛИЦЕТО ЗА КОНТАКТ!',
            'contact_address.min' => 'Минимален брой символи за VIII. АДРЕС НА ЛИЦЕТО ЗА КОНТАКТ - 3!',
            'contact_address.max' => 'Максимален брой символи за VIII. АДРЕС НА ЛИЦЕТО ЗА КОНТАКТ - 500!',
            'contact_address.cyrillic_with' => 'За VIII. АДРЕС НА ЛИЦЕТО ЗА КОНТАКТ пиши на кирилица!!',

            'contact_city.required' => 'Попълни VIII. ГРАДА НА ЛИЦЕТО ЗА КОНТАКТ!',
            'contact_city.min' => 'Минимален брой символи за VIII. ГРАДА НА ЛИЦЕТО ЗА КОНТАКТ - 3!',
            'contact_city.max' => 'Максимален брой символи за VIII. ГРАДА НА ЛИЦЕТО ЗА КОНТАКТ - 500!',
            'contact_city.cyrillic_with' => 'За VIII. ГРАДА НА ЛИЦЕТО ЗА КОНТАКТ пиши на кирилица!!',

            'place.required' => 'Попълни VIII. Място на подаване!',
            'place.min' => 'Минимален брой символи за VIII. Място на подаване - 3!',
            'place.max' => 'Максимален брой символи за VIII. Място на подаване - 500!',
            'place.cyrillic_with' => 'За VIII. Място на подаване пиши на кирилица!!',

            'date_place.required' => 'Дата на подаване е здължителна!',
            'date_place.date_format' => 'Непозволен формат за Дата на подаване!',

            'registration.required' => 'Маркирай - 1. Регистрация като ЗП ДА/НЕ!!',
            'disposition.required' => 'Маркирай - 2. Схема с разположение ...  ДА/НЕ!!',
            'property.required' => 'Маркирай - 3. Документ за право на ...  ДА/НЕ!!',
            'plants_origin.required' => 'Маркирай - 4. Документ запроизход ...  ДА/НЕ!!',

            'registration_note.min' => 'Минимален брой символи за IX. 1. Регистрация като ЗП - 3!',
            'registration_note.max' => 'Максимален брой символи за IX. 1. Регистрация като ЗП - 500!',
            'registration_note.cyrillic_with' => 'За IX. 1. Регистрация като ЗП пиши на кирилица!!',

            'disposition_note.min' => 'Минимален брой символи за IX. 2. Схема с разположение ... - 3!',
            'disposition_note.max' => 'Максимален брой символи за IX. 2. Схема с разположение ... - 500!',
            'disposition_note.cyrillic_with' => 'За IX. 2. Схема с разположение ... пиши на кирилица!!',

            'property_note.min' => 'Минимален брой символи за IX. 3. Документ за право на ... - 3!',
            'property_note.max' => 'Максимален брой символи за IX. 3. Документ за право на ... - 500!',
            'property_note.cyrillic_with' => 'За IX. 3. Документ за право на ...  пиши на кирилица!!',

            'plants_note.min' => 'Минимален брой символи за IX. 4.  Документи за произход на растенията ... - 3!',
            'plants_note.max' => 'Максимален брой символи за IX. 4.  Документи за произход на растенията ... - 500!',
            'plants_note.cyrillic_with' => 'За IX. 4. Документи за произход на растенията ...  пиши на кирилица!!',

            'others_note.min' => 'Минимален брой символи за IX. 5. Други - 3!',
            'others_note.max' => 'Максимален брой символи за IX. 5. Други - 500!',
            'others_note.cyrillic_with' => 'За IX. 5. Други  пиши на кирилица!!',

            'accepted.not_in' => 'Избери инспектора приел документите!',
            'checked.not_in' => 'Избери инспектора проверил документите!',

            'free_text.min' => 'Минимален брой символи за X. СТАНОВИЩЕ НА ИНСПЕКТОРА - 3!',
            'free_text.max' => 'Максимален брой символи за X. СТАНОВИЩЕ НА ИНСПЕКТОРА - 5000!',
            'free_text.cyrillic_with' => 'За X. СТАНОВИЩЕ НА ИНСПЕКТОРА -  пиши на кирилица!!',

            'date_operator.required' => 'Дата на проверката е задължителна!',
            'date_operator.date_format' => 'Непозволен формат за Дата на проверка!',

            'activity.required' => 'Попълни За таблицата Дейност/и по чл. 65(1) !',
            'activity.min' => 'Минимален брой символи за За таблицата Дейност/и по чл. 65(1) - 3!',
            'activity.max' => 'Максимален брой символи за За таблицата Дейност/и по чл. 65(1) - 50!',
            'activity.cyrillic_with' => 'За За таблицата Дейност/и по чл. 65(1) - пиши на кирилица!!',

            'products.required' => 'Попълни За таблицата Растения/естество !',
            'products.min' => 'Минимален брой символи за За таблицата Растения/естество - 3!',
            'products.max' => 'Максимален брой символи за За таблицата Растения/естество - 50!',
            'products.cyrillic_with' => 'За За таблицата Растения/естество - пиши на кирилица!!',

            'derivation.required' => 'Попълни За таблицата Растения/произход !',
            'derivation.min' => 'Минимален брой символи за За таблицата Растения/произход - 3!',
            'derivation.max' => 'Максимален брой символи за За таблицата Растения/произход - 50!',
            'derivation.cyrillic_with' => 'За За таблицата Растения/произход - пиши на кирилица!!',

            'purpose.required' => 'Попълни За таблицата Растения/предназначение !',
            'purpose.min' => 'Минимален брой символи за За таблицата Растения/предназначение - 3!',
            'purpose.max' => 'Максимален брой символи за За таблицата Растения/предназначение - 50!',
            'purpose.cyrillic_with' => 'За За таблицата Растения/предназначение - пиши на кирилица!!',

            'room.min' => 'Минимален брой символи за За таблицата Адрес на помещенията - 3!',
            'room.max' => 'Максимален брой символи за За таблицата Адрес на помещенията - 50!',
            'room.cyrillic_with' => 'За За таблицата Адрес на помещенията - пиши на кирилица!!',

            'action.min' => 'Минимален брой символи за За таблицата Дейност/и по чл. 66(2)  - 3!',
            'action.max' => 'Максимален брой символи за За таблицата Дейност/и по чл. 66(2)  - 50!',
            'action.cyrillic_with' => 'За За таблицата Дейност/и по чл. 66(2)  - пиши на кирилица!!',
        ];
    }
}
