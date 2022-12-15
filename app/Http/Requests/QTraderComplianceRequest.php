<?php

namespace odbh\Http\Requests;

use odbh\Http\Requests\Request;

class QTraderComplianceRequest extends Request
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
        $trader_name = '';
        $trader_address = '';
        $trader_vin = '';
        $name_trader = '';

        if($request['trader_or_not'] == 1) {
            $trader_name = 'required|cyrillic_with|min:3|max:100';
            $trader_address = 'required|cyrillic_with|min:3|max:500';
            $trader_vin = 'required|is_valid|digits_between:9,13';
            $name_trader = 'required|cyrillic_with|min:3|max:500';
        }

        if($request['trader_or_not'] == 0) {
            $trader_name = 'required|cyrillic_with|min:3|max:100';
            $trader_address = 'cyrillic_with|min:5|max:500';
            $trader_vin = 'digits_between:9,13';
            $name_trader = 'cyrillic_with|min:3|max:500';
        }
        return [
            'trader_name' => $trader_name,
            'trader_address' => $trader_address,
            'trader_vin' => $trader_vin,

            'date_compliance' => 'required|date_format:d.m.Y',
            'object_control'=>'required|cyrillic_with|min:3|max:500',
            'name_trader'=>$name_trader,
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
            'trader_name.required' => 'Попълни името на фирмата/Търговеца!',
            'trader_name.min' => 'Минимален брой символи за името - 3!',
            'trader_name.max' => 'Максимален брой символи за името - 100!',
            'trader_name.cyrillic_with' => 'За име на фирма пиши само на кирилица без символи! Позволени символи: (тире - )!',

            'trader_address.required' => 'Адреса е задължителен!',
            'trader_address.min' => 'За Адреса минимален брой символи - 5!',
            'trader_address.max' => 'За Адреса максимален брой символи - 500!',
            'trader_address.cyrillic_with' => 'За Адреса пиши на кирилица!',

            'trader_vin.required' => 'Булстата е задължителен!',
            'trader_vin.digits_between' => 'Булстата е само с цифри! Минимален брой символи - 9',
            'trader_vin.is_valid' => 'Невалиден БУЛСТАТ! Виж дали правилно е попълнен!',


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
