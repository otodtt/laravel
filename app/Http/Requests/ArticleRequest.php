<?php

namespace odbh\Http\Requests;

use odbh\Http\Requests\Request;

class ArticleRequest extends Request
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
            'crops'=>'required|not_in:0',
            'country'=>'required|cyrillic|min:3|max:100',
            'class'=>'required|not_in:0',
            'quantity'=>'required|numeric|min:1',
        ];
    }

    /**
     * Проверка на входящите данни и мои съобщения
     * @return array
     */
    public function messages()
    {
        return [
            'crops.required' => 'Избери култура!',
            'crops.not_in' => 'Избери култура!',

            'country.required' => 'Попълни Страна на произход!',
            'country.min' => 'За Страна на произход минимален брой символи - 3!',
            'country.max' => 'За Страна на произход максимален брой символи - 100!',
            'country.cyrillic' => 'За Страна на произход пиши на кирилица!',

            'class.required' => 'Избери Обявен калс на Качество!',
            'class.not_in' => 'Избери Обявен калс на Качество!',

            'quantity.required' => 'Попълни Количеството!',
            'quantity.numeric' => 'За Количеството използвай само цифри!',
            'quantity.min' => 'Количеството не може да е нула - 0 или отрицателно число!',




            'type_crops.required' => 'Избери дали е за консумация или преработка!',
            'type_crops.not_in' => 'Избери дали е за консумация или преработка!',

            'type_package.required' => 'Избери вида на опаковката!',
            'type_package.not_in' => 'Избери вида на опаковката!',

            'number_packages.required' => 'Броя на опаковките е задължителен!',
            'number_packages.numeric' => 'За Броя на опаковките използвай само цифри!',
            'number_packages.min' => 'Броя на опаковките не може да е нула - 0 или отрицателно число!',



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
