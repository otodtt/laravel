<?php

namespace odbh\Http\Requests;

use odbh\Http\Requests\Request;

class FarmerReportRequest extends Request
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
        $act = null;
        $violation = null;
        $data = array();

        $request = Request::all();
//        dd($request);

        if ($request['is_all'] == 1) {
            $data = [
                'number_report' => 'required|numeric|not_in:0',
                'check_id'=>'required|not_in:0',
                'where_check' => 'required',
                'place' => 'min:3|max:150|cyrillic_with',
                'dimensions' => 'numeric|not_in:0',
                'crops' => 'min:3|max:150|only_cyrillic',

                'starting_time' => 'required|date_format:d.m.Y в H:i',
                'final_hour' => 'date_format:d.m.Y в H:i|after:starting_time',

                'inspector' => 'required',
                'inspector_two' => 'different:inspector',
                'inspector_three' => 'different:inspector|different:inspector_two',
                'inspector_another' => 'min:3|max:50|only_cyrillic|required_with:inspector_from',
                'inspector_from' => 'min:3|max:50|cyrillic_with|required_with:inspector_another',
            ];
        }

        if ($request['is_all'] == 2) {
            $data = [
                'diary' =>'required|not_in:0',
                'diary_note' => 'min:3|max:150|cyrillic_with',
                'primaryR' =>'required|not_in:0',
                'primary_note' => 'min:3|max:150|cyrillic_with',
                'seeds' =>'required|not_in:0',
                'seeds_note' => 'min:3|max:150|cyrillic_with',
                'certificate' =>'required|not_in:0',
                'certificate_note' => 'min:3|max:150|cyrillic_with',
                'testing' =>'required|not_in:0',
                'testing_note' => 'min:3|max:150|cyrillic_with',
                'contract' =>'required|not_in:0',
                'contract_note' => 'min:3|max:150|cyrillic_with',
                'permit' =>'required|not_in:0',
                'permit_note' => 'min:3|max:150|cyrillic_with',
                'disclosure' =>'required|not_in:0',
                'disclosure_note' => 'min:3|max:150|cyrillic_with',
                'spraying' =>'required|not_in:0',
                'spraying_note' => 'min:3|max:150|cyrillic_with',
            ];
        }
        if ($request['is_all'] == 3) {
            $data = [
                'original' =>'required|not_in:0',
                'original_note' => 'min:3|max:150|cyrillic_with',
                'unauthorized' =>'required|not_in:0',
                'unauthorized_note' => 'min:3|max:150|cyrillic_with',
                'expiry' =>'required|not_in:0',
                'expiry_note' => 'min:3|max:150|cyrillic_with',
                'allocation' =>'required|not_in:0',
                'allocation_note' => 'min:3|max:150|cyrillic_with',
                'metal' =>'required|not_in:0',
                'metal_note' => 'min:3|max:150|cyrillic_with',
                'empty' =>'required|not_in:0',
                'empty_note' => 'min:3|max:150|cyrillic_with',
            ];
        }
        if ($request['is_all'] == 4) {
            $data = [
                'permission' =>'required|not_in:0',
                'permission_note' => 'min:3|max:150|cyrillic_with',
                'relevant' =>'required|not_in:0',
                'relevant_note' => 'min:3|max:150|cyrillic_with',
                'concentration' =>'required|not_in:0',
                'concentration_note' => 'min:3|max:150|cyrillic_with',
                'phenophase' =>'required|not_in:0',
                'phenophase_note' => 'min:3|max:150|cyrillic_with',
                'distances' =>'required|not_in:0',
                'distances_note' => 'min:3|max:150|cyrillic_with',
                'buildings' =>'required|not_in:0',
                'buildings_note' => 'min:3|max:150|cyrillic_with',
                'watersheds' =>'required|not_in:0',
                'watersheds_note' => 'min:3|max:150|cyrillic_with',
                'irrigation' =>'required|not_in:0',
                'irrigation_note' => 'min:3|max:150|cyrillic_with',
                'protected' =>'required|not_in:0',
                'protected_note' => 'min:3|max:150|cyrillic_with',
                'cleaning' =>'required|not_in:0',
                'cleaning_note' => 'min:3|max:150|cyrillic_with',
                'evidence' =>'required|not_in:0',
                'evidence_note' => 'min:3|max:150|cyrillic_with',
            ];
        }
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
            'permission.required'=>'За 16. Разрешение за употреба на ПРЗ Задължително избери от възможностите!',
            'permission.not_in:0'=>'За 16. Разрешение за употреба на ПР Задължително избери от възможностите!',
            'permission_note.cyrillic_with' => 'В полето "Забележка 16" пиши само на кирилица!',
            'permission_note.min' => 'Минимален брой символи за полето "Забележка 16" - 3!',
            'permission_note.max' => 'Максимален брой символи за полето "Забележка 16" - 150!',

            'relevant.required'=>'За 17. Разрешение за съответната Задължително избери от възможностите!',
            'relevant.not_in:0'=>'За 17. Разрешение за съответната Задължително избери от възможностите!',
            'relevant_note.cyrillic_with' => 'В полето "Забележка 17" пиши само на кирилица!',
            'relevant_note.min' => 'Минимален брой символи за полето "Забележка 17" - 3!',
            'relevant_note.max' => 'Максимален брой символи за полето "Забележка 17" - 150!',

            'concentration.required'=>'За 18. Доза/концентрация на ПРЗ Задължително избери от възможностите!',
            'concentration.not_in:0'=>'За 18. Доза/концентрация на ПРЗ Задължително избери от възможностите!',
            'concentration_note.cyrillic_with' => 'В полето "Забележка 18" пиши само на кирилица!',
            'concentration_note.min' => 'Минимален брой символи за полето "Забележка 18" - 3!',
            'concentration_note.max' => 'Максимален брой символи за полето "Забележка 18" - 150!',

            'phenophase.required'=>'За 19. Фенофаза на културата Задължително избери от възможностите!',
            'phenophase.not_in:0'=>'За 19. Фенофаза на културата Задължително избери от възможностите!',
            'phenophase_note.cyrillic_with' => 'В полето "Забележка 19" пиши само на кирилица!',
            'phenophase_note.min' => 'Минимален брой символи за полето "Забележка 19" - 3!',
            'phenophase_note.max' => 'Максимален брой символи за полето "Забележка 19" - 150!',

            'distances.required'=>'За 20. Отстояния при приготвяне.. Задължително избери от възможностите!',
            'distances.not_in:0'=>'За 20. Отстояния при приготвяне.. Задължително избери от възможностите!',
            'distances_note.cyrillic_with' => 'В полето "Забележка 20" пиши само на кирилица!',
            'distances_note.min' => 'Минимален брой символи за полето "Забележка 20" - 3!',
            'distances_note.max' => 'Максимален брой символи за полето "Забележка 20" - 150!',

            'buildings.required'=>'За 20.1 100 м от административни.. Задължително избери от възможностите!',
            'buildings.not_in:0'=>'За 20.1 100 м от административни.. Задължително избери от възможностите!',
            'buildings_note.cyrillic_with' => 'В полето "Забележка 20.1" пиши само на кирилица!',
            'buildings_note.min' => 'Минимален брой символи за полето "Забележка 20.1" - 3!',
            'buildings_note.max' => 'Максимален брой символи за полето "Забележка 20.1" - 150!',

            'watersheds.required'=>'За 20.2 200 м от повърхностни водни.. Задължително избери от възможностите!',
            'watersheds.not_in:0'=>'За 20.2 200 м от повърхностни водни.. Задължително избери от възможностите!',
            'watersheds_note.cyrillic_with' => 'В полето "Забележка 20.2" пиши само на кирилица!',
            'watersheds_note.min' => 'Минимален брой символи за полето "Забележка 20.2" - 3!',
            'watersheds_note.max' => 'Максимален брой символи за полето "Забележка 20.2" - 150!',

            'irrigation.required'=>'За 20.3 25 м от напоителни канали Задължително избери от възможностите!',
            'irrigation.not_in:0'=>'За 20.3 25 м от напоителни канали Задължително избери от възможностите!',
            'irrigation_note.cyrillic_with' => 'В полето "Забележка 20.3" пиши само на кирилица!',
            'irrigation_note.min' => 'Минимален брой символи за полето "Забележка 20.3" - 3!',
            'irrigation_note.max' => 'Максимален брой символи за полето "Забележка 20.3" - 150!',

            'protected.required'=>'За 20.4 100 м от защитени територии.. Задължително избери от възможностите!',
            'protected.not_in:0'=>'За 20.4 100 м от защитени територии.. Задължително избери от възможностите!',
            'protected_note.cyrillic_with' => 'В полето "Забележка 20.4" пиши само на кирилица!',
            'protected_note.min' => 'Минимален брой символи за полето "Забележка 20.4" - 3!',
            'protected_note.max' => 'Максимален брой символи за полето "Забележка 20.4" - 150!',

            'cleaning.required'=>'За 21. Обособено място за почистване.. Задължително избери от възможностите!',
            'cleaning.not_in:0'=>'За 21. Обособено място за почистване.. Задължително избери от възможностите!',
            'cleaning_note.cyrillic_with' => 'В полето "Забележка 21" пиши само на кирилица!',
            'cleaning_note.min' => 'Минимален брой символи за полето "Забележка 21" - 3!',
            'cleaning_note.max' => 'Максимален брой символи за полето "Забележка 21" - 150!',

            'evidence.required'=>'За 22. Доказателство за оповестяване Задължително избери от възможностите!',
            'evidence.not_in:0'=>'За 22. Доказателство за оповестяване  Задължително избери от възможностите!',
            'evidence_note.cyrillic_with' => 'В полето "Забележка 22" пиши само на кирилица!',
            'evidence_note.min' => 'Минимален брой символи за полето "Забележка 22" - 3!',
            'evidence_note.max' => 'Максимален брой символи за полето "Забележка 22" - 150!',


            'original.required'=>'За 10. ПРЗ в оргинални опаковки Задължително избери от възможностите!',
            'original.not_in:0'=>'За 10. ПРЗ в оргинални опаковки Задължително избери от възможностите!',
            'original_note.cyrillic_with' => 'В полето "Забележка 10" пиши само на кирилица!',
            'original_note.min' => 'Минимален брой символи за полето "Забележка 10" - 3!',
            'original_note.max' => 'Максимален брой символи за полето "Забележка 10" - 150!',

            'unauthorized.required'=>'За 11. Неразрешени ПРЗ Задължително избери от възможностите!',
            'unauthorized.not_in:0'=>'За 11. Неразрешени ПРЗ Задължително избери от възможностите!',
            'unauthorized_note.cyrillic_with' => 'В полето "Забележка 11" пиши само на кирилица!',
            'unauthorized_note.min' => 'Минимален брой символи за полето "Забележка 11" - 3!',
            'unauthorized_note.max' => 'Максимален брой символи за полето "Забележка 11" - 150!',

            'expiry.required'=>'За 12. Срок на годност на ПРЗ Задължително избери от възможностите!',
            'expiry.not_in:0'=>'За 12. Срок на годност на ПРЗ Задължително избери от възможностите!',
            'expiry_note.cyrillic_with' => 'В полето "Забележка 12" пиши само на кирилица!',
            'expiry_note.min' => 'Минимален брой символи за полето "Забележка 12" - 3!',
            'expiry_note.max' => 'Максимален брой символи за полето "Забележка 12" - 150!',

            'allocation.required'=>'За 13. Разпределение на ПРЗ по функции Задължително избери от възможностите!',
            'allocation.not_in:0'=>'За 13. Разпределение на ПРЗ по функции Задължително избери от възможностите!',
            'allocation_note.cyrillic_with' => 'В полето "Забележка 13" пиши само на кирилица!',
            'allocation_note.min' => 'Минимален брой символи за полето "Забележка 13" - 3!',
            'allocation_note.max' => 'Максимален брой символи за полето "Забележка 13" - 150!',

            'metal.required'=>'За 14. ПРЗ І-ва категория  Задължително избери от възможностите!',
            'metal.not_in:0'=>'За 14. ПРЗ І-ва категория  Задължително избери от възможностите!',
            'metal_note.cyrillic_with' => 'В полето "Забележка 14" пиши само на кирилица!',
            'metal_note.min' => 'Минимален брой символи за полето "Забележка 14" - 3!',
            'metal_note.max' => 'Максимален брой символи за полето "Забележка 14" - 150!',

            'empty.required'=>'За 15. Обособено място за.. Задължително избери от възможностите!',
            'empty.not_in:0'=>'За 15. Обособено място за.. Задължително избери от възможностите!',
            'empty_note.cyrillic_with' => 'В полето "Забележка 15" пиши само на кирилица!',
            'empty_note.min' => 'Минимален брой символи за полето "Забележка 15" - 3!',
            'empty_note.max' => 'Максимален брой символи за полето "Забележка 15" - 150!',


            'diary.required'=>'За 1. Дневник Задължително избери от възможностите!',
            'diary.not_in:0'=>'За 1. Дневник Задължително избери от възможностите!',
            'diary_note.cyrillic_with' => 'В полето "Забележка 1" пиши само на кирилица!',
            'diary_note.min' => 'Минимален брой символи за полето "Забележка 1" - 3!',
            'diary_note.max' => 'Максимален брой символи за полето "Забележка 1" - 150!',

            'primaryR.required'=>'За 2. Първични Задължително избери от възможностите!',
            'primaryR.not_in:0'=>'За 2. Първични Задължително избери от възможностите!',
            'primary_note.cyrillic_with' => 'В полето "Забележка 2" пиши само на кирилица!',
            'primary_note.min' => 'Минимален брой символи за полето "Забележка 2" - 3!',
            'primary_note.max' => 'Максимален брой символи за полето "Забележка 2" - 150!',

            'seeds.required'=>'За 3. Сертификат за семена Задължително избери от възможностите!',
            'seeds.not_in:0'=>'За 3. Сертификат за семена Задължително избери от възможностите!',
            'seeds_note.cyrillic_with' => 'В полето "Забележка 3" пиши само на кирилица!',
            'seeds_note.min' => 'Минимален брой символи за полето "Забележка 3" - 3!',
            'seeds_note.max' => 'Максимален брой символи за полето "Забележка 3" - 150!',

            'certificate.required'=>'За 4. Сертификат Задължително избери от възможностите!',
            'certificate.not_in:0'=>'За 4. Сертификат Задължително избери от възможностите!',
            'certificate_note.cyrillic_with' => 'В полето "Забележка 4" пиши само на кирилица!',
            'certificate_note.min' => 'Минимален брой символи за полето "Забележка 4" - 3!',
            'certificate_note.max' => 'Максимален брой символи за полето "Забележка 4" - 150!',

            'testing.required'=>'За 5. Протокол Задължително избери от възможностите!',
            'testing.not_in:0'=>'За 5. Протокол Задължително избери от възможностите!',
            'testing_note.cyrillic_with' => 'В полето "Забележка 5" пиши само на кирилица!',
            'testing_note.min' => 'Минимален брой символи за полето "Забележка 5" - 3!',
            'testing_note.max' => 'Максимален брой символи за полето "Забележка 5" - 150!',

            'contract.required'=>'За 6. Договор с фирма, Задължително избери от възможностите!',
            'contract.not_in:0'=>'За 6. Договор с фирма, Задължително избери от възможностите!',
            'contract_note.cyrillic_with' => 'В полето "Забележка 6" пиши само на кирилица!',
            'contract_note.min' => 'Минимален брой символи за полето "Забележка 6" - 3!',
            'contract_note.max' => 'Максимален брой символи за полето "Забележка 6" - 150!',

            'permit.required'=>'За 7. Разрешение Задължително избери от възможностите!',
            'permit.not_in:0'=>'За 7. Разрешение Задължително избери от възможностите!',
            'permit_note.cyrillic_with' => 'В полето "Забележка 7" пиши само на кирилица!',
            'permit_note.min' => 'Минимален брой символи за полето "Забележка 7" - 3!',
            'permit_note.max' => 'Максимален брой символи за полето "Забележка 7" - 150!',

            'disclosure.required'=>'За 8. Оповестяване Задължително избери от възможностите!',
            'disclosure.not_in:0'=>'За 8. Оповестяване Задължително избери от възможностите!',
            'disclosure_note.cyrillic_with' => 'В полето "Забележка 8" пиши само на кирилица!',
            'disclosure_note.min' => 'Минимален брой символи за полето "Забележка 8" - 3!',
            'disclosure_note.max' => 'Максимален брой символи за полето "Забележка 8" - 150!',

            'spraying.required'=>'За 9. Договор за извършване Задължително избери от възможностите!',
            'spraying.not_in:0'=>'За 9. Договор за извършване Задължително избери от възможностите!',
            'spraying_note.cyrillic_with' => 'В полето "Забележка 9" пиши само на кирилица!',
            'spraying_note.min' => 'Минимален брой символи за полето "Забележка 9" - 3!',
            'spraying_note.max' => 'Максимален брой символи за полето "Забележка 9" - 150!',


            'number_report.required' => 'Номера на Доклада е здължителен!',
            'number_report.numeric' => 'За номер на Доклада използвай само цифри!',
            'number_report.not_in' => 'Номера на Доклада не може да нула - 0!',

            'check_id.required'=>'Задължително избери вида на проверката!',
            'check_id.not_in'=>'Задължително избери вида на проверката!',

            'dimensions.numeric' => 'Размера на стопанството трябва да е число!',
            'dimensions.not_in' => 'Размера на стопанството не може да е НУЛА!',

            'place.cyrillic_with' => 'В полето "МЯСТО НА ПРОВЕРКАТА:" пиши само на кирилица!',
            'place.min' => 'Минимален брой символи за полето "МЯСТО НА ПРОВЕРКАТА:" - 3!',
            'place.max' => 'Максимален брой символи за полето "МЯСТО НА ПРОВЕРКАТА:" - 150!',

            'crops.only_cyrillic' => 'За Отглеждани култури - Пиши само на кирилица',
            'crops.min' => 'Минимален брой символи за полето "Отглеждани култури:" - 3!',
            'crops.max' => 'Максимален брой символи за полето "Отглеждани култури:" - 150!',

            'where_check.required' => 'Маркирай дали проверката е документална или в стопанството!',

            'starting_time.required' => 'Началната Датата на Доклада е здължителна!',
            'starting_time.date_format' => 'Непозволен формат за Начална Дата на Доклада!',

            'final_hour.date_format' => 'Непозволен формат за Начална Дата на Доклада!',
            'final_hour.after' => '"Дата и краен час" трябва да са след "Дата и начален час"!',

            'inspector.required' => 'Задължително избери водещ инспектор!',
            'inspector_two.different' => 'Не може да бъде избиран един и същ инспектор!',
            'inspector_three.different' => 'Не може да бъде избиран един и същ инспектор!',

            'inspector_another.min' => 'Минимален брой символи за име на инспектор - 3!',
            'inspector_another.max' => 'Максимален брой символи за име на инспектор - 50!',
            'inspector_another.only_cyrillic' => 'За името на инспектора използвай само на кирилица!',
            'inspector_another.required_with' => 'Попълни полето името на инспектора!',

            'inspector_from.min' => 'Минимален брой символи за полето "От служба:" - 3!',
            'inspector_from.max' => 'Максимален брой символи за полето "От служба:" - 50!',
            'inspector_from.cyrillic_with' => 'За полето "От служба:" използвай само на кирилица!',
            'inspector_from.required_with' => 'Попълни полето "От служба:"!',

        ];
        return $data;
    }

}

//'assay_error.not_in' => 'Задължително маркирай дали има взета проба или вида на пробата!',
//
//'assay_more_name.min' => 'Минимален брой символи за полето "Проба от:" - 2!',
//'assay_more_name.max' => 'Максимален брой символи за полето "Проба от:" - 100!',
//'assay_more_name.only_cyrillic' => 'За полето "Проба от:" - Пиши само на кирилица',
//'assay_more_name.required_if' => 'Маркирано е, че има взета проба за остатъци от ПРЗ. Напиши културата!',
//
//'assay_prz_name.min' => 'Минимален брой символи за полето "Проба от:" - 2!',
//'assay_prz_name.max' => 'Максимален брой символи за полето "Проба от:" - 100!',
//'assay_prz_name.only_cyrillic' => 'За полето "Проба от:" - Пиши само на кирилица',
//'assay_prz_name.required_if' => 'Маркирано е, че има взета проба за индентификация на ПРЗ. Напиши културата!',
//
//'assay_tor_name.min' => 'Минимален брой символи за полето "Проба от:" - 2!',
//'assay_tor_name.max' => 'Максимален брой символи за полето "Проба от:" - 100!',
//'assay_tor_name.only_cyrillic' => 'За полето "Проба от:" - Пиши само на кирилица',
//'assay_tor_name.required_if' => 'Маркирано е, че има взета проба за нитрати. Напиши културата!',
//
//'assay_metal_name.min' => 'Минимален брой символи за полето "Проба от:" - 2!',
//'assay_metal_name.max' => 'Максимален брой символи за полето "Проба от:" - 100!',
//'assay_metal_name.only_cyrillic' => 'За полето "Проба от:" - Пиши само на кирилица',
//'assay_metal_name.required_if' => 'Маркирано е, че има взета проба за Тежки метали. Напиши културата!',
//
//'assay_micro_name.min' => 'Минимален брой символи за полето "Проба от:" - 2!',
//'assay_micro_name.max' => 'Максимален брой символи за полето "Проба от:" - 100!',
//'assay_micro_name.only_cyrillic' => 'За полето "Проба от:" - Пиши само на кирилица',
//'assay_micro_name.required_if' => 'Маркирано е, че има взета проба за Микробиологични замърсители. Напиши културата!',
//
//'assay_other_name.min' => 'Минимален брой символи за полето "Проба от:" - 2!',
//'assay_other_name.max' => 'Максимален брой символи за полето "Проба от:" - 100!',
//
//'assay_other_name.required_if' => 'Маркирано е, че има взета проба. Напиши културата!',
