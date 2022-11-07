<?php

namespace odbh\Http\Requests;


class ProtocolsUpdateRequest extends Request
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
        $data = array();
        $request = Request::all();

        if(!isset($request['act']) || $request['act'] == 0){
            $data = [
                'type_check' => 'required',
                'number' => 'required|numeric|not_in:0',
                'date_protocol' => 'required|date_format:d.m.Y',
                'inspector' => 'required',
                'inspector_two' => 'different:inspector',
                'inspector_three' => 'different:inspector|different:inspector_two',
                'inspector_another' => 'min:3|max:50|cyrillic|required_with:inspector_from',
                'inspector_from' => 'min:3|max:50|cyrillic_with|required_with:inspector_another',

                'violation' => 'required',
                'act' => 'required_if:violation,1|required',

                'ascertainment' => 'min:5|max:5000|required_if:violation,1',
                'taken' => 'min:5|max:5000',
                'order_protocol' => 'min:5|max:5000|required_if:violation,1',
                'assay_prz' => 'required',
                'assay_tor' => 'required',
            ];
        }
        if(isset($request['act']) && $request['act'] == 1){
            $data = [
                'type_check' => 'required',
                'number' => 'required|numeric|not_in:0',
                'date_protocol' => 'required|date_format:d.m.Y',
                'inspector' => 'required',
                'inspector_two' => 'different:inspector',
                'inspector_three' => 'different:inspector|different:inspector_two',
                'inspector_another' => 'min:3|max:50|cyrillic|required_with:inspector_from',
                'inspector_from' => 'min:3|max:50|cyrillic_with|required_with:inspector_another',

                'violation' => 'in:1|required',

                'ascertainment' => 'min:5|max:5000|required_if:violation,1',
                'taken' => 'min:5|max:5000',
                'order_protocol' => 'min:5|max:5000|required_if:violation,1',
                'assay_prz' => 'required',
                'assay_tor' => 'required',
            ];
        }
        return $data;
    }

    /**
     * Мои съобщения за грешки.
     * @return array
     */
    public function messages()
    {
        $data = array();
        $request = Request::all();

        if(!isset($request['act']) || $request['act'] == 0){
            $data = [
                'type_check.required' => 'Задължително маркирай вида на проверката!',

                'number.required' => 'Номера на Протокола е здължителен!',
                'number.numeric' => 'За номер на Протокола използвай само цифри!',
                'number.not_in' => 'Номера на Протокола не може да нула - 0!',

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
                'inspector_from.cyrillic' => 'За полето "От служба:" използвай само на кирилица!',
                'inspector_from.required_with' => 'Попълни полето "От служба:"!',

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

                'assay_prz.required' => 'Задължително маркирай дали има взета проба от ПРЗ!',
                'assay_tor.required' => 'Задължително маркирай дали има взета проба от ТОР!',
            ];
        }
        if(isset($request['act']) && $request['act'] == 1){
            $data = [
                'type_check.required' => 'Задължително маркирай вида на проверката!',

                'number.required' => 'Номера на Протокола е здължителен!',
                'number.numeric' => 'За номер на Протокола използвай само цифри!',
                'number.not_in' => 'Номера на Протокола не може да нула - 0!',

                'date_protocol.required' => 'Датата на Протокола е здължителна!',
                'date_protocol.date_format' => 'Непозволен формат за Дата на Протокол!',

                'inspector.required' => 'Задължително избери водещ инспектор!',
                'inspector_two.different' => 'Не може да бъде избиран един и същ инспектор!',
                'inspector_three.different' => 'Не може да бъде избиран един и същ инспектор!',

                'inspector_another.min' => 'Минимален брой символи за име на инспектор - 3!',
                'inspector_another.max' => 'Максимален брой символи за име на инспектор - 50!',
                'inspector_another.cyrillic' => 'За името на инспектора използвай само на кирилица!',
                'inspector_another.required_with' => 'Попълни полето името на инспектора!',

                'inspector_from.min' => 'Минимален брой символи за полето "От служба:" - 3!',
                'inspector_from.max' => 'Максимален брой символи за полето "От служба:" - 50!',
                'inspector_from.only_cyrillic' => 'За полето "От служба:" използвай само на кирилица!',
                'inspector_from.required_with' => 'Попълни полето "От служба:"!',


                'violation.in' => 'Не може да има АКТ без нарушение! Маркирай с ДА в полето "Констатирани нарушения: "',
                'violation.required' => 'Задължително маркирай дали има Констатирани нарушения!',

                'ascertainment.min' => 'Минимален брой символи за полето "Констатация:" - 5!',
                'ascertainment.max' => 'Максимален брой символи за полето "Констатация:" - 5000!',
                'ascertainment.required_if' => 'Маркирано е, че има нарушрние. Опиши нарушението в полето "Констатация:" !',

                'taken.min' => 'Минимален брой символи за полето "Конфискувани:" - 5!',
                'taken.max' => 'Максимален брой символи за полето "Конфискувани:" - 5000!',

                'order_protocol.min' => 'Минимален брой символи за полето "Предписание:" - 5!',
                'order_protocol.max' => 'Максимален брой символи за полето "Предписание:" - 5000!',
                'order_protocol.required_if' => 'Маркирано е, че има нарушрние. Опиши направените предписания!',

                'assay_prz.required' => 'Задължително маркирай дали има взета проба от ПРЗ!',
                'assay_tor.required' => 'Задължително маркирай дали има взета проба от ТОР!',
            ];
        }
        return $data;
    }
}
