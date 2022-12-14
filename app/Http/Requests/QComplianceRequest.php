<?php

namespace odbh\Http\Requests;

use odbh\Http\Requests\Request;

class QComplianceRequest extends Request
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
            'date_compliance' => 'required|date_format:d.m.Y',
            'object_control'=>'required|cyrillic_with|min:3|max:500',
            'name_trader'=>'required|cyrillic_with|min:3|max:500',
            'notes' => 'required',
            'inspectors' => 'required|not_in:0'
        ];
    }

    /**
     * Мои съобщения за грешки.
     *
     * @return array
     */
    public function messages() {
        $data = [
            'date_compliance.required' => 'Датата на Формуляра е здължителна!',
            'date_compliance.date_format' => 'Непозволен формат за Дата на Формуляр!',

            'object_control.required' => 'Попълни Обекта на контрол!',
            'object_control.cyrillic_with' => 'За Обекта на контрол използвай кирилица без символите ( )!',
            'object_control.min' => 'За Обекта на контрол - минимален брой символи - 3!',
            'object_control.max' => 'За Обекта на контрол - максимален брой символи - 500!',

            'name_trader.required' => 'Попълни Трите имена на търговеца или на негов представител!',
            'name_trader.cyrillic_with' => 'За Трите имена на търговеца или на негов представител използвай кирилица без символите ( )!',
            'name_trader.min' => 'За Трите имена на търговеца или на негов представитела - минимален брой символи - 3!',
            'name_trader.max' => 'За Трите имена на търговеца или на негов представител - максимален брой символи - 500!',

            'notes.required' => 'Попълни дали отговаря на изискванията за качество!',

            'inspectors.required' => 'Избери инспектора извършил проверката!',
            'inspectors.not_in' => 'Избери инспектора извършил проверката!',
        ];
        return $data;
    }
}
