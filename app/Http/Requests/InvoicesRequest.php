<?php

namespace odbh\Http\Requests;

use odbh\Http\Requests\Request;

class InvoicesRequest extends Request
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
        if( isset($request['domestic_sum']) && $request['domestic_sum'] == 3333) {
            $sum = 'required|numeric|min:1';
        } else {
            $sum = '';
        }
        return [
            'invoice'=> 'required|numeric|min:1',
            'date_invoice'=> 'required|date_format:d.m.Y',
            'sum'=> $sum,
        ];
    }

    /**
     * Проверка на входящите данни и мои съобщения
     * @return array
     */
    public function messages()
    {
        return [
            'invoice.required' => 'Номера на Фактурата е здължителен!',
            'invoice.numeric' => 'За номер на Фактура използвай само цифри!',
            'invoice.min' => 'Номера на Фактурата не може да е нула - 0 или отрицателно число!',

            'date_invoice.required' => 'Дата на Фактурата е здължителна!',
            'date_invoice.date_format' => 'Непозволен формат за Дата на Фактура!',

            'sum.required' => 'Сумата е здължителна!',
            'sum.numeric' => 'За сумата на Фактура използвай ТОЧКА или само цифри! ',
            'sum.min' => 'Сумата не може да е нула - 0 или отрицателно число!',
        ];
    }
}
