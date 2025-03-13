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
            if(isset($request['assay_prz']) && $request['assay_prz'] == 1){
                $assay_prz = 'required';
                $prz_name = 'required|min:2|max:100|cyrillic_with';
                $prz_av = 'required|min:2|max:100';
                $request['edit'];
            }
            else{
                $assay_prz = 'required';
                $prz_name = '';
                $prz_av = '';
            }

            if(isset($request['assay_tor']) && $request['assay_tor'] == 1){
                $assay_tor = 'required';
                $tor_name = 'min:2|max:100|required';
                $eo_tor = 'required_if:assay_tor,1';
            }
            else{
                $assay_tor = 'required';
                $tor_name = '';
                $eo_tor = '';
            }
        }
        if($request['edit'] == 1) {
            $assay_prz = 'required';
            $assay_tor = 'required';
            $prz_name = '';
            $prz_av = '';
            $tor_name = '';
            $eo_tor = '';
        }

        $data = [
            'type_check' => 'required',
            'number' => 'required|numeric|not_in:0',
            'date_report' => 'required|date_format:d.m.Y',
            'inspector' => 'required',
            'inspector_two' => 'different:inspector',
            'inspector_three' => 'different:inspector|different:inspector_two',
            'inspector_another' => 'min:3|max:50|cyrillic|required_with:inspector_from',
            'inspector_from' => 'min:3|max:50|cyrillic_with|required_with:inspector_another',

            'assay_prz' => $assay_prz,
            'prz_name' => $prz_name,
            'prz_av' => $prz_av,

            'assay_tor' => $assay_tor,
            'tor_name' => $tor_name,
            'tor_av' => 'min:2|max:100',
            'eo_tor' => $eo_tor,

            'activity' => 'required',
            'activity_note' => 'min:3|max:50|cyrillic_with',
            'certificate' => 'required',
            'certificate_note' => 'min:3|max:50|cyrillic_with',
            'delivery' => 'required',
            'delivery_note' => 'min:3|max:50|cyrillic_with',
            'sales' => 'required',
            'sales_note' => 'min:3|max:50|cyrillic_with',
            'unauthorized' => 'required',
            'unauthorized_note' => 'min:3|max:50|cyrillic_with',
            'first' => 'required',
            'first_note' => 'min:3|max:50|cyrillic_with',
            'improperly' => 'required',
            'improperly_note' => 'min:3|max:50|cyrillic_with',
            'repackaged' => 'required',
            'repackaged_note' => 'min:3|max:50|cyrillic_with',
            'expired' => 'required',
            'expired_note' => 'min:3|max:50|cyrillic_with',
            'compliance' => 'required',
            'compliance_note' => 'min:3|max:50|cyrillic_with',
            'leaflet' => 'required',
            'leaflet_note' => 'min:3|max:50|cyrillic_with',
            'larger' => 'required',
            'larger_note' => 'min:3|max:50|cyrillic_with',
            'purpose' => 'required',
            'purpose_note' => 'min:3|max:50|cyrillic_with',
            'storage' => 'required',
            'storage_note' => 'min:3|max:50|cyrillic_with',
            'warehouse' => 'required',
            'warehouse_note' => 'min:3|max:50|cyrillic_with',
            'separated' => 'required',
            'separated_note' => 'min:3|max:50|cyrillic_with',
            'access' => 'required',
            'access_note' => 'min:3|max:50|cyrillic_with',
            'flooring' => 'required',
            'flooring_note' => 'min:3|max:50|cyrillic_with',
            'combustible' => 'required',
            'combustible_note' => 'min:3|max:50|cyrillic_with',
            'contract' => 'required',
            'contract_note' => 'min:3|max:50|cyrillic_with',
            'protocol' => 'required',
            'protocol_number' => 'numeric|not_in:0|required_if:protocol,1',
            'protocol_date' => 'date_format:d.m.Y|required_if:protocol,1',
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

            'date_report.required' => 'Датата на Доклада е здължителна!',
            'date_report.date_format' => 'Непозволен формат за Дата на Доклад!',

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
            'prz_name.required' => 'Маркирано е, че има взета проба. Напиши името на Продукта!',
            'prz_name.cyrillic_with' => 'За името на Продукта пиши на кирилица!',
            'prz_name.min' => 'Минимален брой символи за полето "Име на ПРЗ:" - 2!',
            'prz_name.max' => 'Максимален брой символи за полето "Име на ПРЗ:" - 100!',
            'prz_av.min' => 'Минимален брой символи за полето "А. Веществово:" - 2!',
            'prz_av.max' => 'Максимален брой символи за полето "А. Веществово:" - 100!',

            'assay_tor.required' => 'Задължително маркирай дали има взета проба от ТОР!',
            'tor_name.required' => 'Маркирано е, че има взета проба. Напиши името на Тора!',
            'tor_name.min' => 'Минимален брой символи за полето "Име на ТОР:" - 2!',
            'tor_name.max' => 'Максимален брой символи за полето "Име на ТОР:" - 100!',
            'tor_av.min' => 'Минимален брой символи за полето "Съдържание:" - 2!',
            'tor_av.max' => 'Максимален брой символи за полето "Съдържание:" - 100!',
            'eo_tor.required_if' => 'Маркирай дали има маркировка СЕ!',

            'activity.required' => 'Задължително маркирай - 1. Удостоверение за дейността!',
            'activity_note.cyrillic_with' => 'За Забелека 1 използвай само на кирилица!',
            'activity_note.min' => 'Минимален брой символи за полето "За Забелека 1:" - 3!',
            'activity_note.max' => 'Максимален брой символи за полето "За Забелека 1:" - 50!',

            'certificate.required' => 'Задължително маркирай - 2. Сертификат по чл. 83 на лицето!',
            'certificate_note.cyrillic_with' => 'За Забелека 2 използвай само на кирилица!',
            'certificate_note.min' => 'Минимален брой символи за полето "За Забелека 2:" - 3!',
            'certificate_note.max' => 'Максимален брой символи за полето "За Забелека 2:" - 50!',

            'delivery.required' => 'Задължително маркирай - 3. Дневник на доставките!',
            'delivery_note.cyrillic_with' => 'За Забелека 3 използвай само на кирилица!',
            'delivery_note.min' => 'Минимален брой символи за полето "За Забелека 3:" - 3!',
            'delivery_note.max' => 'Максимален брой символи за полето "За Забелека 3:" - 50!',

            'sales.required' => 'Задължително маркирай - 4. Дневник на продажбите!',
            'sales_note.cyrillic_with' => 'За Забелека 4 използвай само на кирилица!',
            'sales_note.min' => 'Минимален брой символи за полето "За Забелека 4:" - 3!',
            'sales_note.max' => 'Максимален брой символи за полето "За Забелека 4:" - 50!',

            'unauthorized.required' => 'Задължително маркирай - 5. Неразрешени ПРЗ!',
            'unauthorized_note.cyrillic_with' => 'За Забелека 5 използвай само на кирилица!',
            'unauthorized_note.min' => 'Минимален брой символи за полето "За Забелека 5:" - 3!',
            'unauthorized_note.max' => 'Максимален брой символи за полето "За Забелека 5:" - 50!',

            'first.required' => 'Задължително маркирай - 6. ПРЗ от първа професионална категория!',
            'first_note.cyrillic_with' => 'За Забелека 6 използвай само на кирилица!',
            'first_note.min' => 'Минимален брой символи за полето "За Забелека 6:" - 3!',
            'first_note.max' => 'Максимален брой символи за полето "За Забелека 6:" - 50!',

            'improperly.required' => 'Задължително маркирай - 7. Неправомерно преопаковани!',
            'improperly_note.cyrillic_with' => 'За Забелека 7 използвай само на кирилица!',
            'improperly_note.min' => 'Минимален брой символи за полето "За Забелека 7:" - 3!',
            'improperly_note.max' => 'Максимален брой символи за полето "За Забелека 7:" - 50!',

            'repackaged.required' => 'Задължително маркирай - 8. Преопаковане на ПРЗ в аптеката!',
            'repackaged_note.cyrillic_with' => 'За Забелека 8 използвай само на кирилица!',
            'repackaged_note.min' => 'Минимален брой символи за полето "За Забелека 8:" - 3!',
            'repackaged_note.max' => 'Максимален брой символи за полето "За Забелека 8:" - 50!',

            'expired.required' => 'Задължително маркирай - 9. ПРЗ с изтекъл срок на годност!',
            'expired_note.cyrillic_with' => 'За Забелека 9 използвай само на кирилица!',
            'expired_note.min' => 'Минимален брой символи за полето "За Забелека 9:" - 3!',
            'expired_note.max' => 'Максимален брой символи за полето "За Забелека 9:" - 50!',

            'compliance.required' => 'Задължително маркирай - 10. Съответствие на етикета!',
            'compliance_note.cyrillic_with' => 'За Забелека 10 използвай само на кирилица!',
            'compliance_note.min' => 'Минимален брой символи за полето "За Забелека 10:" - 3!',
            'compliance_note.max' => 'Максимален брой символи за полето "За Забелека 10:" - 50!',

            'leaflet.required' => 'Задължително маркирай - 11. Листовка трайно закрепена за опаковката!',
            'leaflet_note.cyrillic_with' => 'За Забелека 11 използвай само на кирилица!',
            'leaflet_note.min' => 'Минимален брой символи за полето "За Забелека 11:" - 3!',
            'leaflet_note.max' => 'Максимален брой символи за полето "За Забелека 11:" - 50!',

            'larger.required' => 'Задължително маркирай - 12. ПРЗ в опаковка по-голяма от 1 л/кг!',
            'larger_note.cyrillic_with' => 'За Забелека 12 използвай само на кирилица!',
            'larger_note.min' => 'Минимален брой символи за полето "За Забелека 12:" - 3!',
            'larger_note.max' => 'Максимален брой символи за полето "За Забелека 12:" - 50!',

            'purpose.required' => 'Задължително маркирай - 13. Подреждане по предназначение!',
            'purpose_note.cyrillic_with' => 'За Забелека 13 използвай само на кирилица!',
            'purpose_note.min' => 'Минимален брой символи за полето "За Забелека 13:" - 3!',
            'purpose_note.max' => 'Максимален брой символи за полето "За Забелека 13:" - 50!',

            'storage.required' => 'Задължително маркирай - 14. Съхранение на ПРЗ!',
            'storage_note.cyrillic_with' => 'За Забелека 14 използвай само на кирилица!',
            'storage_note.min' => 'Минимален брой символи за полето "За Забелека 14:" - 3!',
            'storage_note.max' => 'Максимален брой символи за полето "За Забелека 14:" - 50!',

            'warehouse.required' => 'Задължително маркирай - 15. Складово помещение в ССА!',
            'warehouse_note.cyrillic_with' => 'За Забелека 15 използвай само на кирилица!',
            'warehouse_note.min' => 'Минимален брой символи за полето "За Забелека 15:" - 3!',
            'warehouse_note.max' => 'Максимален брой символи за полето "За Забелека 15:" - 50!',

            'separated.required' => 'Задължително маркирай - 15.1 да е отделено от търговската част на обекта и ...!',
            'separated_note.cyrillic_with' => 'За Забелека 15.1 използвай само на кирилица!',
            'separated_note.min' => 'Минимален брой символи за полето "За Забелека 15.1:" - 3!',
            'separated_note.max' => 'Максимален брой символи за полето "За Забелека 15.1:" - 50!',

            'access.required' => 'Задължително маркирай - 15.2 да е осигурен контролиран и ограничен досъп ...!',
            'access_note.cyrillic_with' => 'За Забелека 15.2 използвай само на кирилица!',
            'access_note.min' => 'Минимален брой символи за полето "За Забелека 15.2:" - 3!',
            'access_note.max' => 'Максимален брой символи за полето "За Забелека 15.2:" - 50!',

            'flooring.required' => 'Задължително маркирай - 15.3 да има подови настилки, непропускливи за ...!',
            'flooring_note.cyrillic_with' => 'За Забелека 15.3 използвай само на кирилица!',
            'flooring_note.min' => 'Минимален брой символи за полето "За Забелека 15.3:" - 3!',
            'flooring_note.max' => 'Максимален брой символи за полето "За Забелека 15.3:" - 50!',

            'combustible.required' => 'Задължително маркирай - 15.4 стените, таваните и вратите да са изградени от ...!',
            'combustible_note.cyrillic_with' => 'За Забелека 15.4 използвай само на кирилица!',
            'combustible_note.min' => 'Минимален брой символи за полето "За Забелека 15.4:" - 3!',
            'combustible_note.max' => 'Максимален брой символи за полето "За Забелека 15.4:" - 50!',

            'contract.required' => 'Задължително маркирай - 16. Договор за предаване на негодни ПРЗ!',
            'contract_note.cyrillic_with' => 'За Забелека 16 използвай само на кирилица!',
            'contract_note.min' => 'Минимален брой символи за полето "За Забелека 16:" - 3!',
            'contract_note.max' => 'Максимален брой символи за полето "За Забелека 16:" - 50!',

            'protocol.required' => 'Задължително маркирай дали има издаден Констативен Протокол!',

            'protocol_number.required_if' => 'Маркирано е, че има Протокол. Номера на Протокола е здължителен!',
            'protocol_number.numeric' => 'За номер на Протокола използвай само цифри!',
            'protocol_number.not_in' => 'Номера на Протокола не може да нула - 0!',

            'protocol_date.required_if' => 'Маркирано е, че има Протокол. Датата на Протокола е здължителна!',
            'protocol_date.date_format' => 'Маркирано е, че има Протокол. Непозволен формат за Дата на Протокола!',
        ];

        return $data;
    }
}
