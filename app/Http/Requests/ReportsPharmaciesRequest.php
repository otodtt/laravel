<?php

namespace odbh\Http\Requests;

use odbh\Http\Requests\Request;

class ReportsPharmaciesRequest extends Request
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
        if(!isset($request['edit']) || $request['edit'] == 0) {
            $prz_name = 'min:2|max:100|required_if:assay_prz,1';
            $prz_av = 'min:2|max:100';
            $tor_name = 'min:2|max:100|required_if:assay_tor,1';
            $eo_tor = 'required_if:assay_tor,1';
        }
        if(isset($request['edit']) || $request['edit'] == 1) {
            $prz_name = 'min:2|max:100';
            $prz_av = 'min:2|max:100';

            $tor_name = 'min:2|max:100';
            $eo_tor = '';
        }
//        dd($request);
        $data = [
            'type_check' => 'required',
            'number' => 'required|numeric|not_in:0',
            'date_protocol' => 'required|date_format:d.m.Y',
            'inspector' => 'required',
            'inspector_two' => 'different:inspector',
            'inspector_three' => 'different:inspector|different:inspector_two',
            'inspector_another' => 'min:3|max:50|cyrillic|required_with:inspector_from',
            'inspector_from' => 'min:3|max:50|cyrillic_with|required_with:inspector_another',

            'assay_prz' => 'required',
            'prz_name' => $prz_name,
            'prz_av' => $prz_av,

            'assay_tor' => 'required',
            'tor_name' => $tor_name,
            'tor_av' => 'min:2|max:100',
            'eo_tor' => $eo_tor,

            'activity' => 'required',
            'activity_note' => 'cyrillic_with',
            'certificate' => 'required',
            'certificate_note' => 'cyrillic_with',
            'delivery' => 'required',
            'delivery_note' => 'cyrillic_with',
            'sales' => 'required',
            'sales_note' => 'cyrillic_with',
            'unauthorized' => 'required',
            'unauthorized_note' => 'cyrillic_with',
            'first' => 'required',
            'first_note' => 'cyrillic_with',
            'improperly' => 'required',
            'improperly_note' => 'cyrillic_with',
            'repackaged' => 'required',
            'repackaged_note' => 'cyrillic_with',
            'expired' => 'required',
            'expired_note' => 'cyrillic_with',
            'compliance' => 'required',
            'compliance_note' => 'cyrillic_with',
            'leaflet' => 'required',
            'leaflet_note' => 'cyrillic_with',
            'larger' => 'required',
            'larger_note' => 'cyrillic_with',
            'purpose' => 'required',
            'purpose_note' => 'cyrillic_with',
            'storage' => 'required',
            'storage_note' => 'cyrillic_with',
            'warehouse' => 'required',
            'warehouse_note' => 'cyrillic_with',
            'separated' => 'required',
            'separated_note' => 'cyrillic_with',
            'access' => 'required',
            'access_note' => 'cyrillic_with',
            'flooring' => 'required',
            'flooring_note' => 'cyrillic_with',
            'combustible' => 'required',
            'combustible_note' => 'cyrillic_with',
            'contract' => 'required',
            'contract_note' => 'cyrillic_with',
            'protocol' => 'required',
        ];
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
            'type_check.required' => 'Задължително маркирай вида на проверката!',

            'number.required' => 'Номера на Доклада е здължителен!',
            'number.numeric' => 'За номер на Доклада използвай само цифри!',
            'number.not_in' => 'Номера на Доклада не може да нула - 0!',

            'date_protocol.required' => 'Датата на Доклада е здължителна!',
            'date_protocol.date_format' => 'Непозволен формат за Дата на Доклад!',

            'inspector.required' => 'Задължително избери водещ инспектор!',
            'inspector_two.different' => 'Не може да бъде избиран един и същ инспектор!',
            'inspector_three.different' => 'Не може да бъде избиран един и същ инспектор!',

            'inspector_another.min' => 'Минимален брой символи за име на инспектор - 3!',
            'inspector_another.max' => 'Максимален брой символи за име на инспектор - 50!',
            'inspector_another.cyrillic' => 'За името на инспектора използвай само на кирилица!',
            'inspector_another.required_with' => 'Попълни полето името на инспектора!',

            'inspector_from.min' => 'Минимален брой символи за полето "От служба:" - 3!',
            'inspector_from.max' => 'Максимален брой символи за полето "От служба:" - 50!',
            'inspector_from.cyrillic_with' => 'За полето "От служба:" използвай само на кирилица!',
            'inspector_from.required_with' => 'Попълни полето "От служба:"!',

            'assay_prz.required' => 'Задължително маркирай дали има взета проба от ПРЗ!',
            'prz_name.required_if' => 'Маркирано е, че има взета проба. Напиши името на Продукта!',
            'prz_name.min' => 'Минимален брой символи за полето "Име на ПРЗ:" - 2!',
            'prz_name.max' => 'Максимален брой символи за полето "Име на ПРЗ:" - 100!',
            'prz_av.min' => 'Минимален брой символи за полето "А. Веществово:" - 2!',
            'prz_av.max' => 'Максимален брой символи за полето "А. Веществово:" - 100!',

            'assay_tor.required' => 'Задължително маркирай дали има взета проба от ТОР!',
            'tor_name.required_if' => 'Маркирано е, че има взета проба. Напиши името на Тора!',
            'tor_name.min' => 'Минимален брой символи за полето "Име на ТОР:" - 2!',
            'tor_name.max' => 'Максимален брой символи за полето "Име на ТОР:" - 100!',
            'tor_av.min' => 'Минимален брой символи за полето "Съдържание:" - 2!',
            'tor_av.max' => 'Максимален брой символи за полето "Съдържание:" - 100!',
            'eo_tor.required_if' => 'Маркирай дали има маркировка ЕО тор!',

            'activity.required' => 'Задължително маркирай - 1. Удостоверение за дейността!',
            'activity_note.cyrillic_with' => 'За Забелека 1 използвай само на кирилица!',

            'certificate.required' => 'Задължително маркирай - 2. Сертификат по чл. 83 на лицето!',
            'certificate_note.cyrillic_with' => 'За Забелека 2 използвай само на кирилица!',

            'delivery.required' => 'Задължително маркирай - 3. Дневник на доставките!',
            'delivery_note.cyrillic_with' => 'За Забелека 3 използвай само на кирилица!',

            'sales.required' => 'Задължително маркирай - 4. Дневник на продажбите!',
            'sales_note.cyrillic_with' => 'За Забелека 4 използвай само на кирилица!',

            'unauthorized.required' => 'Задължително маркирай - 5. Неразрешени ПРЗ!',
            'unauthorized_note.cyrillic_with' => 'За Забелека 5 използвай само на кирилица!',

            'first.required' => 'Задължително маркирай - 6. ПРЗ от първа професионална категория!',
            'first_note.cyrillic_with' => 'За Забелека 6 използвай само на кирилица!',

            'improperly.required' => 'Задължително маркирай - 7. Неправомерно преопаковани!',
            'improperly_note.cyrillic_with' => 'За Забелека 7 използвай само на кирилица!',

            'repackaged.required' => 'Задължително маркирай - 8. Преопаковане на ПРЗ в аптеката!',
            'repackaged_note.cyrillic_with' => 'За Забелека 8 използвай само на кирилица!',

            'expired.required' => 'Задължително маркирай - 9. ПРЗ с изтекъл срок на годност!',
            'expired_note.cyrillic_with' => 'За Забелека 9 използвай само на кирилица!',

            'compliance.required' => 'Задължително маркирай - 10. Съответствие на етикета!',
            'compliance_note.cyrillic_with' => 'За Забелека 10 използвай само на кирилица!',

            'leaflet.required' => 'Задължително маркирай - 11. Листовка трайно закрепена за опаковката!',
            'leaflet_note.cyrillic_with' => 'За Забелека 11 използвай само на кирилица!',

            'larger.required' => 'Задължително маркирай - 12. ПРЗ в опаковка по-голяма от 1 л/кг!',
            'larger_note.cyrillic_with' => 'За Забелека 12 използвай само на кирилица!',

            'purpose.required' => 'Задължително маркирай - 13. Подреждане по предназначение!',
            'purpose_note.cyrillic_with' => 'За Забелека 13 използвай само на кирилица!',

            'storage.required' => 'Задължително маркирай - 14. Съхранение на ПРЗ!',
            'storage_note.cyrillic_with' => 'За Забелека 14 използвай само на кирилица!',

            'warehouse.required' => 'Задължително маркирай - 15. Складово помещение в ССА!',
            'warehouse_note.cyrillic_with' => 'За Забелека 15 използвай само на кирилица!',

            'separated.required' => 'Задължително маркирай - 15.1 да е отделено от търговската част на обекта и ...!',
            'separated_note.cyrillic_with' => 'За Забелека 15.1 използвай само на кирилица!',

            'access.required' => 'Задължително маркирай - 15.2 да е осигурен контролиран и ограничен досъп ...!',
            'access_note.cyrillic_with' => 'За Забелека 15.2 използвай само на кирилица!',

            'flooring.required' => 'Задължително маркирай - 15.3 да има подови настилки, непропускливи за ...!',
            'flooring_note.cyrillic_with' => 'За Забелека 15.3 използвай само на кирилица!',

            'combustible.required' => 'Задължително маркирай - 15.4 стените, таваните и вратите да са изградени от ...!',
            'combustible_note.cyrillic_with' => 'За Забелека 15.4 използвай само на кирилица!',

            'contract.required' => 'Задължително маркирай - 16. Договор за предаване на негодни ПРЗ!',
            'contract_note.cyrillic_with' => 'За Забелека 16 използвай само на кирилица!',

            'protocol.required' => 'Задължително маркирай дали има издаден Констативен Протокол!',
        ];

        return $data;
    }
}
