<?php

namespace odbh\Http\Requests;

//use odbh\Http\Requests\Request;

class FarmerProtocolRequest extends Request
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

        $request = Request::all();
        if(!isset($request['act']) || $request['act'] == 0){
            $violation = 'required';
            $act = 'required_if:violation,1|required';
        }
        if(isset($request['act']) && $request['act'] == 1){
            $violation = 'in:1|required';
            $act = '';
        }
        if(!isset($request['assay_no']) || !isset($request['assay_more']) || !isset($request['assay_prz'])  || !isset($request['assay_tor'])
            || !isset($request['assay_metal']) || !isset($request['assay_micro']) || !isset($request['assay_other'])){
            $assay_error = 'not_in:0';
        }
        else{
            $assay_error = '';
        }
        $data = [
            'check_id'=>'required|not_in:0',
            'type_check' => 'required',
            'number_protocol' => 'required|numeric|not_in:0',
            'date_protocol' => 'required|date_format:d.m.Y',
            'inspector' => 'required',
            'inspector_two' => 'different:inspector',
            'inspector_three' => 'different:inspector|different:inspector_two',
            'inspector_another' => 'min:3|max:50|only_cyrillic|required_with:inspector_from',
            'inspector_from' => 'min:3|max:50|cyrillic_with|required_with:inspector_another',

            'violation' => $violation,
            'act' => $act,

            'ascertainment' => 'min:5|max:5000|required_if:violation,1',
            'taken' => 'min:5|max:5000',
            'order_protocol' => 'min:5|max:5000|required_if:violation,1',

            'assay_error'=>$assay_error,

            'assay_more_name' => 'min:2|max:100|required_if:assay_more,1|only_cyrillic',
            'assay_prz_name' => 'min:2|max:100|required_if:assay_prz,1|only_cyrillic',
            'assay_tor_name' => 'min:2|max:100|required_if:assay_tor,1|only_cyrillic',
            'assay_metal_name' => 'min:2|max:100|required_if:assay_metal,1|only_cyrillic',
            'assay_micro_name' => 'min:2|max:100|required_if:assay_micro,1|only_cyrillic',
            'assay_other_name' => 'min:2|max:100|required_if:assay_other,1|only_cyrillic',

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
            'check_id.required'=>'Задължително избери вида на проверката!',
            'check_id.not_in'=>'Задължително избери вида на проверката!',

            'type_check.required' => 'Маркирай дали проверката е документална или на терен!',

            'number_protocol.required' => 'Номера на Протокола е здължителен!',
            'number_protocol.numeric' => 'За номер на Протокола използвай само цифри!',
            'number_protocol.not_in' => 'Номера на Протокола не може да нула - 0!',

            'date_protocol.required' => 'Датата на Протокола е здължителна!',
            'date_protocol.date_format' => 'Непозволен формат за Дата на Протокол!',

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

            'violation.in' => 'Не може да има АКТ без нарушение! Маркирай с ДА в полето "Констатирани нарушения: "',
            'violation.required' => 'Задължително маркирай дали има Констатирани нарушения!',

            'act.required_if' => 'Маркирано е, че има нарушрние. Маркирай дали има съставен АКТ!',
            'act.required' => 'Маркирай дали има съставен АКТ!',

            'ascertainment.min' => 'Минимален брой символи за полето "Констатация:" - 5!',
            'ascertainment.max' => 'Максимален брой символи за полето "Констатация:" - 5000!',
            'ascertainment.required_if' => 'Маркирано е, че има нарушрние. Опиши нарушението в полето "Констатация:" !',

            'taken.min' => 'Минимален брой символи за полето "Конфискувани:" - 5!',
            'taken.max' => 'Максимален брой символи за полето "Конфискувани:" - 5000!',

            'order_protocol.min' => 'Минимален брой символи за полето "Предписание:" - 5!',
            'order_protocol.max' => 'Максимален брой символи за полето "Предписание:" - 5000!',
            'order_protocol.required_if' => 'Маркирано е, че има нарушрние. Опиши направените предписания!',

            'assay_error.not_in' => 'Задължително маркирай дали има взета проба или вида на пробата!',

            'assay_more_name.min' => 'Минимален брой символи за полето "Проба от:" - 2!',
            'assay_more_name.max' => 'Максимален брой символи за полето "Проба от:" - 100!',
            'assay_more_name.only_cyrillic' => 'За полето "Проба от:" - Пиши само на кирилица',
            'assay_more_name.required_if' => 'Маркирано е, че има взета проба за остатъци от ПРЗ. Напиши културата!',

            'assay_prz_name.min' => 'Минимален брой символи за полето "Проба от:" - 2!',
            'assay_prz_name.max' => 'Максимален брой символи за полето "Проба от:" - 100!',
            'assay_prz_name.only_cyrillic' => 'За полето "Проба от:" - Пиши само на кирилица',
            'assay_prz_name.required_if' => 'Маркирано е, че има взета проба за индентификация на ПРЗ. Напиши културата!',

            'assay_tor_name.min' => 'Минимален брой символи за полето "Проба от:" - 2!',
            'assay_tor_name.max' => 'Максимален брой символи за полето "Проба от:" - 100!',
            'assay_tor_name.only_cyrillic' => 'За полето "Проба от:" - Пиши само на кирилица',
            'assay_tor_name.required_if' => 'Маркирано е, че има взета проба за нитрати. Напиши културата!',

            'assay_metal_name.min' => 'Минимален брой символи за полето "Проба от:" - 2!',
            'assay_metal_name.max' => 'Максимален брой символи за полето "Проба от:" - 100!',
            'assay_metal_name.only_cyrillic' => 'За полето "Проба от:" - Пиши само на кирилица',
            'assay_metal_name.required_if' => 'Маркирано е, че има взета проба за Тежки метали. Напиши културата!',

            'assay_micro_name.min' => 'Минимален брой символи за полето "Проба от:" - 2!',
            'assay_micro_name.max' => 'Максимален брой символи за полето "Проба от:" - 100!',
            'assay_micro_name.only_cyrillic' => 'За полето "Проба от:" - Пиши само на кирилица',
            'assay_micro_name.required_if' => 'Маркирано е, че има взета проба за Микробиологични замърсители. Напиши културата!',

            'assay_other_name.min' => 'Минимален брой символи за полето "Проба от:" - 2!',
            'assay_other_name.max' => 'Максимален брой символи за полето "Проба от:" - 100!',
            'assay_other_name.only_cyrillic' => 'За полето "Проба от:" - Пиши само на кирилица',
            'assay_other_name.required_if' => 'Маркирано е, че има взета проба. Напиши културата!',
        ];
        return $data;
    }
}
