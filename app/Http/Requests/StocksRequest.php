<?php

namespace odbh\Http\Requests;

use odbh\Http\Requests\Request;

class StocksRequest extends Request
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

        if ($request['type_package'] == 999) {
            $different = 'required|min:3|max:100';
        } else {
            $different = '';
        }

        return [
            'type_crops'=>'required|not_in:0',
            'type_package'=>'required|not_in:0',
            'number_packages'=>'required|numeric|min:1',
            'crops'=>'required|not_in:0',
            'variety'=>'min:3|max:300',
            'quality_class'=>'required|not_in:0',
            'weight'=>'required|numeric|min:1',
            'different'=> $different,
        ];
    }

    /**
     * Проверка на входящите данни и мои съобщения
     * @return array
     */
    public function messages()
    {
        return [
            'type_crops.required' => 'Избери дали е за консумация или преработка!',
            'type_crops.not_in' => 'Избери дали е за консумация или преработка!',

            'type_package.required' => 'Избери вида на опаковката!',
            'type_package.not_in' => 'Избери вида на опаковката!',

            'number_packages.required' => 'Броя на опаковките е задължителен!',
            'number_packages.numeric' => 'За Броя на опаковките използвай само цифри!',
            'number_packages.min' => 'Броя на опаковките не може да е нула - 0 или отрицателно число!',

            'crops.required' => 'Избери култура!',
            'crops.not_in' => 'Избери култура!',

            'variety.min' => 'Сорта се изписва с минимум 2 символа!',
            'variety.max' => 'Сорта се изписва с максимум 300 символа!',

            'quality_class.required' => 'Избери Качеството!',
            'quality_class.not_in' => 'Избери Качеството!',

            'weight.required' => 'Попълни Количеството!',
            'weight.numeric' => 'За Количеството използвай само цифри!',
            'weight.min' => 'Количеството не може да е нула - 0 или отрицателно число!',

            'different.required' => 'За опаковката е избрано ДРУГО. Напиши опаковката!',
            'different.min' => 'Опаковката се изписва с минимум 3 символа!',
            'different.max' => 'Опаковката се изписва с максимум 100 символа!',

        ];
    }
}
